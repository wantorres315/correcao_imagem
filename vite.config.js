import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import postcss from 'rollup-plugin-postcss';
import postcssNesting from 'postcss-nesting';


export default defineConfig({
    plugins: [
       
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css'],
               
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
        postcss({
            plugins: [
                postcssNesting(), // Add postcss nesting plugin before Tailwind
            ],
        }),
    ],
    resolve: {
        alias: {
            $: "jQuery",
        },
    },
})