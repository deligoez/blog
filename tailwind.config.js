module.exports = {
    purge: [
        './resources/**/*.antlers.html',
        './resources/**/*.blade.php',
        './content/**/*.md'
    ],
    darkMode: false, // or 'media' or 'class'
    important: true,
    theme: {
        extend: {
            fontFamily: {
                'serif': ['Equity Text A', 'Times New Roman', 'Times', 'Georgia', 'Cambria', 'ui-serif', 'serif'],
                'caps': ['Equity Caps A', 'serif'],
                'index': ['concourse-t3-index', 'sans'],
                'source': ['Dank Mono', 'monospace'],
            },
            keyframes: {
                wiggle: {
                    '0%, 100%': {transform: 'rotate(-3deg)'},
                    '50%': {transform: 'rotate(3deg)'},
                }
            },
            animation: {
                wiggle: 'wiggle 1s ease-in-out infinite',
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
