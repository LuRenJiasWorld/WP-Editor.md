emojify.setConfig({
    img_dir: 'https:' === document.location.protocol ? "https://staticfile.qnssl.com/emoji-cheat-sheet/1.0.0" : "http://cdn.staticfile.org/emoji-cheat-sheet/1.0.0",
    blacklist: {
        'ids': [],
        'classes': ['no-emojify'],
        'elements': ['^script$', '^textarea$', '^pre$', '^code$']
    }
});
emojify.run();