import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        server: {
        host: '127.0.0.1', // Força o Vite a escutar no mesmo IP do artisan serve
        port: 5173,
    },
    ],
});
