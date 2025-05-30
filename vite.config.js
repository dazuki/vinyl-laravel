import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import htmlPurge from "vite-plugin-purgecss";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
    htmlPurge({
      content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.css",
      ],
      defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
    }),
  ],
  build: {
    sourcemap: true,
  },
});
