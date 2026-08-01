import { Zalo, LoginQRCallbackEventType } from "zca-js";
import fs from "fs";
import path from "path";

const credentialsPath = path.resolve("./storage/data/zalo_credentials.json");

// Ensure directory exists
const dir = path.dirname(credentialsPath);
if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
}

console.log("Initializing Zalo login flow...");
const zalo = new Zalo();

try {
    const api = await zalo.loginQR({}, async (event) => {
        switch (event.type) {
            case LoginQRCallbackEventType.QRCodeGenerated:
                console.log("QR Code generated!");
                // Save QR to a file to scan
                const qrPath = path.resolve("./storage/data/zalo_qr.png");
                await event.actions.saveToFile(qrPath);
                console.log(`Please scan the QR code saved at: ${qrPath}`);
                break;
            case LoginQRCallbackEventType.QRCodeExpired:
                console.log("QR Code expired! Retrying...");
                event.actions.retry();
                break;
            case LoginQRCallbackEventType.QRCodeScanned:
                console.log("QR Code scanned by:", event.data.display_name);
                break;
            case LoginQRCallbackEventType.QRCodeDeclined:
                console.log("QR Code declined! Retrying...");
                event.actions.retry();
                break;
            case LoginQRCallbackEventType.GotLoginInfo:
                console.log("Successfully retrieved login credentials!");
                fs.writeFileSync(credentialsPath, JSON.stringify(event.data, null, 2));
                console.log(`Credentials saved to ${credentialsPath}`);
                break;
        }
    });

    console.log("Logged in successfully! Own ID:", api.getOwnId());
    process.exit(0);
} catch (e) {
    console.error("Login failed:", e);
    process.exit(1);
}
