// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty
import { defineConfig, loadEnv } from 'vite';
import liveReload from 'vite-plugin-live-reload';
// import path from 'path';

const { resolve } = require('path');
const fs = require('fs');

export default defineConfig(({ command, mode }) => {
  const isServeCommand = command === 'serve';

  // const commonConfig = {
  return {
    plugins: [liveReload([resolve(__dirname, 'src/**/*.scss'), resolve(__dirname, '**/*.php')])],
    root: '',
    base: process.env.NODE_ENV === 'development' ? '/' : '/dist/',
    cssCodeSplit: true,
    build: {
      outDir: resolve(__dirname, './dist'),
      emptyOutDir: false,
      manifest: false,
      target: 'es2018',
      minify: true,
      write: true,
      cssCodeSplit: true,
      rollupOptions: {
        input: {
          app: resolve(__dirname, 'src/app.js'),
        },
        output: {
          entryFileNames: `[name].min.js`,
          assetFileNames: `[name].min.[ext]`,
        },
      },
    },
    resolve: {
      alias: {
        '@': resolve(__dirname, isServeCommand ? './wp-content/themes/nfa/dist/images' : './dist/images'),
      },
    },
    server: {
      port: 2222,
      strictPort: true,
      cors: true,
      https: false,
      hmr: {
        host: 'localhost',
      },
    },
  };

  // return commonConfig;
});
