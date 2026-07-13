new TypeIt('.title', {
    strings: 'William Stolworthy',
    afterComplete: function (instance) {
        instance.destroy();

        new TypeIt('.subtitle', {
            startDelay: 900,
        })
        .type("I'm a ")
        .type('<span class="subtitle-normal">Web Developer</span>')
        .pause(800)
        .delete('.subtitle-normal', {
            delay: 800,
            instant: false
        })
        .type('<strong>Web Developer</strong>')
        .go();
    },
}).go();