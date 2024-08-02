import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import fs from 'fs';

export default defineConfig(({ command, mode }) => {
    const env = loadEnv(mode, process.cwd(), '')
    return {
        server: {
            host: true,
            port: process.env.VITE_ASSET_PORT,
            strictPort: true,
            hmr: {
                host: env.VITE_ASSET_HOST,
                port: env.VITE_HMR_ASSET_PORT,
            },
            https: {
                key: fs.readFileSync(env.VITE_PRIVKEY_PATH),
                cert: fs.readFileSync(env.VITE_CERT_PATH),
            },
        },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        })
    ]
}
});
