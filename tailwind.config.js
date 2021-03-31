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
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
