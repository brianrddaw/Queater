// vite.config.js
import { defineConfig } from "file:///C:/Users/Programaci%C3%B3n/Desktop/PROYECTO%20FINAL/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/Users/Programaci%C3%B3n/Desktop/PROYECTO%20FINAL/node_modules/laravel-vite-plugin/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    }),
    {
      name: "blade",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".blade.php")) {
          server.ws.send({
            type: "full-reload",
            path: "*"
          });
        }
      }
    }
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxQcm9ncmFtYWNpXHUwMEYzblxcXFxEZXNrdG9wXFxcXFBST1lFQ1RPIEZJTkFMXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxQcm9ncmFtYWNpXHUwMEYzblxcXFxEZXNrdG9wXFxcXFBST1lFQ1RPIEZJTkFMXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9Vc2Vycy9Qcm9ncmFtYWNpJUMzJUIzbi9EZXNrdG9wL1BST1lFQ1RPJTIwRklOQUwvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tIFwidml0ZVwiO1xuaW1wb3J0IGxhcmF2ZWwgZnJvbSBcImxhcmF2ZWwtdml0ZS1wbHVnaW5cIjtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFtcInJlc291cmNlcy9jc3MvYXBwLmNzc1wiLCBcInJlc291cmNlcy9qcy9hcHAuanNcIl0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAge1xuICAgICAgICAgICAgbmFtZTogXCJibGFkZVwiLFxuICAgICAgICAgICAgaGFuZGxlSG90VXBkYXRlKHsgZmlsZSwgc2VydmVyIH0pIHtcbiAgICAgICAgICAgICAgICBpZiAoZmlsZS5lbmRzV2l0aChcIi5ibGFkZS5waHBcIikpIHtcbiAgICAgICAgICAgICAgICAgICAgc2VydmVyLndzLnNlbmQoe1xuICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogXCJmdWxsLXJlbG9hZFwiLFxuICAgICAgICAgICAgICAgICAgICAgICAgcGF0aDogXCIqXCIsXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0sXG4gICAgXSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUF1VSxTQUFTLG9CQUFvQjtBQUNwVyxPQUFPLGFBQWE7QUFFcEIsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTyxDQUFDLHlCQUF5QixxQkFBcUI7QUFBQSxNQUN0RCxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsSUFDRDtBQUFBLE1BQ0ksTUFBTTtBQUFBLE1BQ04sZ0JBQWdCLEVBQUUsTUFBTSxPQUFPLEdBQUc7QUFDOUIsWUFBSSxLQUFLLFNBQVMsWUFBWSxHQUFHO0FBQzdCLGlCQUFPLEdBQUcsS0FBSztBQUFBLFlBQ1gsTUFBTTtBQUFBLFlBQ04sTUFBTTtBQUFBLFVBQ1YsQ0FBQztBQUFBLFFBQ0w7QUFBQSxNQUNKO0FBQUEsSUFDSjtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
