[github.com/RFS-ADRENO/zca-js.git](https://github.com/RFS-ADRENO/zca-js.git)


# ZCA-JS

[](https://github.com/RFS-ADRENO/zca-js#zca-js)

Note

This is an unofficial Zalo API for personal account. It work by simulating the browser to interact with Zalo Web.

Warning

Using this API could get your account locked or banned. We are not responsible for any issues that may happen. Use it at your own risk.

---

## Table of Contents

[](https://github.com/RFS-ADRENO/zca-js#table-of-contents)

* [Installation](https://github.com/RFS-ADRENO/zca-js#installation)
  * [Migrate to V2](https://github.com/RFS-ADRENO/zca-js#migrate-to-v2)
* [Documentation](https://github.com/RFS-ADRENO/zca-js#documentation)
* [Basic Usages](https://github.com/RFS-ADRENO/zca-js#basic-usages)
  * [Login](https://github.com/RFS-ADRENO/zca-js#login)
  * [Listen for new messages](https://github.com/RFS-ADRENO/zca-js#listen-for-new-messages)
  * [Send a message](https://github.com/RFS-ADRENO/zca-js#send-a-message)
  * [Get/Send a sticker](https://github.com/RFS-ADRENO/zca-js#getsend-a-sticker)
* [Example](https://github.com/RFS-ADRENO/zca-js#example)
* [Projects &amp; Useful Resources](https://github.com/RFS-ADRENO/zca-js#projects--useful-resources)
* [Contributing](https://github.com/RFS-ADRENO/zca-js#contributing)
* [License](https://github.com/RFS-ADRENO/zca-js#license)
* [Support Us](https://github.com/RFS-ADRENO/zca-js#support-us)

## Installation

[](https://github.com/RFS-ADRENO/zca-js#installation)

```shell
bun add zca-js # or npm install zca-js
```

### Migrate to V2

[](https://github.com/RFS-ADRENO/zca-js#migrate-to-v2)

Since official version 2.0.0, `zca-js` has removed sharp dependency for image metadata extraction. It now requires users to provide their own `imageMetadataGetter` function when initializing the `Zalo` class if they want to send images/gifs by file path.

Example of custom `imageMetadataGetter` using `sharp`:

```shell
bun add sharp # or npm install sharp
```

```js
import { Zalo } from "zca-js";
import sharp from "sharp";
import fs from "node:fs";

async function imageMetadataGetter(filePath) {
    const data = await fs.promises.readFile(filePath);
    const metadata = await sharp(data).metadata();
    return {
        height: metadata.height,
        width: metadata.width,
        size: metadata.size || data.length,
    };
}

const zalo = new Zalo({
    imageMetadataGetter,
});
```

---

## Documentation

[](https://github.com/RFS-ADRENO/zca-js#documentation)

See [API Documentation](https://zca-js.tdung.com/) for more details.

---

## Basic Usages

[](https://github.com/RFS-ADRENO/zca-js#basic-usages)

### Login

[](https://github.com/RFS-ADRENO/zca-js#login)

```js
import { Zalo } from "zca-js";

const zalo = new Zalo();
const api = await zalo.loginQR();
```

### Listen for new messages

[](https://github.com/RFS-ADRENO/zca-js#listen-for-new-messages)

```js
import { Zalo, ThreadType } from "zca-js";

const zalo = new Zalo();
const api = await zalo.loginQR();

api.listener.on("message", (message) => {
    const isPlainText = typeof message.data.content === "string";

    switch (message.type) {
        case ThreadType.User: {
            if (isPlainText) {
                // received plain text direct message
            }
            break;
        }
        case ThreadType.Group: {
            if (isPlainText) {
                // received plain text group message
            }
            break;
        }
    }
});

api.listener.start();
```

Important

Only one web listener can run per account at a time. If you open Zalo in the browser while the listener is active, the listener will be automatically stopped.

### Send a message

[](https://github.com/RFS-ADRENO/zca-js#send-a-message)

```js
import { Zalo, ThreadType } from "zca-js";

const zalo = new Zalo();
const api = await zalo.loginQR();

// Echo bot
api.listener.on("message", (message) => {
    const isPlainText = typeof message.data.content === "string";
    if (message.isSelf || !isPlainText) return;

    switch (message.type) {
        case ThreadType.User: {
            api.sendMessage(
                {
                    msg: "echo: " + message.data.content,
                    quote: message.data, // the message to reply to (optional)
                },
                message.threadId,
                message.type, // ThreadType.User
            );
            break;
        }
        case ThreadType.Group: {
            api.sendMessage(
                {
                    msg: "echo: " + message.data.content,
                    quote: message.data, // the message to reply to (optional)
                },
                message.threadId,
                message.type, // ThreadType.Group
            );
            break;
        }
    }
});

api.listener.start();
```

### Get/Send a sticker

[](https://github.com/RFS-ADRENO/zca-js#getsend-a-sticker)

```js
api.getStickers("hello").then(async (stickerIds) => {
    // Get the first sticker
    const stickerObject = await api.getStickersDetail(stickerIds[0]);
    api.sendMessageSticker(
        stickerObject,
        message.threadId,
        message.type, // ThreadType.User or ThreadType.Group
    );
});
```

---

## Example

[](https://github.com/RFS-ADRENO/zca-js#example)

See [examples](https://github.com/RFS-ADRENO/zca-js/blob/main/examples) folder for more details.

---

## Projects & Useful Resources

[](https://github.com/RFS-ADRENO/zca-js#projects--useful-resources)

| Repository                                                                       | Description                                                                                                                                     |
| :------------------------------------------------------------------------------- | :---------------------------------------------------------------------------------------------------------------------------------------------- |
| [**ZaloDataExtractor**](https://github.com/JustKemForFun/ZaloDataExtractor) | A browser`Extension` to extract IMEI, cookies, and user agent from Zalo Web.                                                                  |
| [**MultiZlogin**](https://github.com/ChickenAI/multizlogin)                 | A multi-account Zalo management system that lets you log in to and manage multiple accounts simultaneously, with proxy and webhook integration. |
| [**n8n-nodes-zalo-tools**](https://github.com/ChickenAI/zalo-node)          | N8N node for personal Zalo account.                                                                                                             |
| [**Zalo-F12**](https://github.com/ElectroHeavenVN/Zalo-F12)                 | A collection of JavaScript code snippets to paste into DevTools to change how Zalo Web/PC works.                                                |
| [**Zalo-F12-Tools**](https://github.com/JustKemForFun/Zalo-F12-Tools)       | Toggle hidden modes for Zalo Web.                                                                                                               |

---

API DOCS: [zca-js.tdung.com/](https://zca-js.tdung.com/vi/get-started/introduction.html)

## Contributing

[](https://github.com/RFS-ADRENO/zca-js#contributing)

We welcome contributions from the community! Please see our [Contributing Guidelines](https://github.com/RFS-ADRENO/zca-js/blob/main/CONTRIBUTING.md) for details on how to:

* 🐛 Report bugs and issues
* ✨ Suggest new features
* 🔧 Submit code contributions
* 📚 Improve documentation
* 🧪 Add or improve tests
* 🔒 Report security vulnerabilities

For more information, please read our [Code of Conduct](https://github.com/RFS-ADRENO/zca-js/blob/main/CODE_OF_CONDUCT.md) and [Security Policy](https://github.com/RFS-ADRENO/zca-js/blob/main/SECURITY.md) before participating.

---

## License

[](https://github.com/RFS-ADRENO/zca-js#license)

This project is licensed under the MIT License - see the [LICENSE](https://github.com/RFS-ADRENO/zca-js/blob/main/LICENSE) file for details.

---

## **Support Us**

[](https://github.com/RFS-ADRENO/zca-js#support-us)

* ⭐ **Star our repositories** if you find them useful!
* 🔄 **Share** with your network to help us grow
* 💡 **Contribute** your ideas and code
* ☕  **A coffee** :
  * [Buy Me a Coffee](https://ko-fi.com/grosse)
  * [Paypal](https://www.paypal.com/paypalme/dungto213)
  * [VietQR](https://github.com/user-attachments/assets/e1f319d6-9d11-4082-8248-55b55e645caa)
  * [Momo](https://me.momo.vn/gMIMulsaUqsbf6iAiXt3)
