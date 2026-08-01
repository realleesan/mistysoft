import { Zalo } from "zca-js";
import fs from "fs";
import path from "path";

const credentialsPath = path.resolve("./storage/data/zalo_credentials.json");

if (!fs.existsSync(credentialsPath)) {
    console.error(JSON.stringify({ success: false, error: "Zalo not authenticated. Please run zalo_auth script first." }));
    process.exit(1);
}

const credentials = JSON.parse(fs.readFileSync(credentialsPath, "utf-8"));
const messageText = process.argv[2];

if (!messageText) {
    console.error(JSON.stringify({ success: false, error: "Message text is required." }));
    process.exit(1);
}

try {
    const zalo = new Zalo();
    const api = await zalo.login(credentials);
    const ownId = api.getOwnId();
    
    await api.sendMessage({ msg: messageText }, ownId);
    
    console.log(JSON.stringify({ success: true }));
    process.exit(0);
} catch (e) {
    console.error(JSON.stringify({ success: false, error: e.message || String(e) }));
    process.exit(1);
}
