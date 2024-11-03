import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/layout.css',
                'resources/css/chart_custom.css',
                'resources/js/app.js',
                'resources/js/layout.js',
                'resources/js/tenant.js',
                'resources/js/chart_custom.js',
                'resources/js/paymentMethod.js',
            ],
            refresh: true,
        }),
    ],
});
