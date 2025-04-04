import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Incluye el archivo SCSS aquí
                'resources/js/app.js',    // Incluye el archivo JS aquí
            ],
            refresh: true, // Esto es solo para desarrollo
        }),
    ],
    build: {
        outDir: 'public/build', // Directorio de salida en producción
        emptyOutDir: true,
    },
});
