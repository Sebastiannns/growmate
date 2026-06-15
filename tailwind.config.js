import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // Font Poppins
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            // GrowMate color palette
            colors: {
                primary: {
                    DEFAULT: '#4B7BE5',
                    dark: '#3A63C5',
                    light: '#B8D4FC',
                },
                accent: {
                    DEFAULT: '#C4B5FD',
                    dark: '#A78BFA',
                    light: '#DDD6FE',
                },
                background: '#F9FAFB',
                'soft-text': '#9CA3AF',
                label: '#6B7280',
                border: '#E5E7EB',
            },
            // Max width mirip mobile (430px)
            maxWidth: {
                mobile: '430px',
            },
            // Padding untuk halaman
            padding: {
                page: '24px',
                card: '16px',
            },
            // Tinggi tombol konsisten
            height: {
                btn: '50px',
            },
            // Bottom nav padding bawah
            paddingBottom: {
                nav: '80px',
            },
            // Font sizes sesuai figma-reference
            fontSize: {
                xs: ['10px', '14px'],
                sm: ['13px', '20px'],
                base: ['15px', '24px'],
                lg: ['18px', '28px'],
                xl: ['20px', '28px'],
                '2xl': ['24px', '32px'],
            },
            // Border radius
            borderRadius: {
                '2xl': '16px',
                '3xl': '24px',
            },
            // Shadows
            boxShadow: {
                card: '0px 2px 8px rgba(0, 0, 0, 0.06)',
                nav: '0px -2px 12px rgba(0, 0, 0, 0.06)',
            },
            // Scales
            scale: {
                102: '1.02',
            },
        },
    },

    plugins: [forms],
};
