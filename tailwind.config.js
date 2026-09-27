import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                fcGreenDark: '#1d3528',  // O tom exato de verde escuro do teu banner
                fcCoral: '#e0533c',      // O tom do botão/links de destaque
                fcBgLight: '#f4f5f0',    // O fundo claro da página
                fcTextMuted: '#667085',  // O texto cinzento
                fcTextDark: '#101828',   // O texto principal escuro
                fcGreenCard: '#142e23', // Verde escuro para o painel principal
                fcGreenBox: '#1c3e30',  // Verde ligeiramente mais claro para os blocos inferiores
                fcCoral: '#e07a5f',
            },
        },
    },

    plugins: [forms],
};