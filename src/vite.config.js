import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/library.js',
                'resources/css/library.css'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
    },
});
