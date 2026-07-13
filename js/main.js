if (document.querySelector('.title')) { // so it only works on index.html and i dont have to load CDN on all pages
    new TypeIt('.title', {
        strings: 'William Stolworthy',
        afterComplete: function (instance) {
            instance.destroy();

            new TypeIt('.subtitle', {
                startDelay: 900,
                afterComplete: function (instance) {
                    instance.destroy();
                },
            })
            .type("I'm a ")
            .type('<span class="subtitle-normal">Web Developer</span>')
            .pause(800)
            .delete('.subtitle-normal', {
                delay: 800,
                instant: false
            })
            .type('<strong>Web Developer.</strong>')
            .go();
        },
    }).go();
}

const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('.sidebar');

hamburger.addEventListener('click', function () {
    const open = sidebar.classList.toggle('is-open');
    hamburger.setAttribute('aria-expanded', String(open));
});

sidebar.querySelectorAll('.sidebar-nav a').forEach(function (link) {
    link.addEventListener('click', function () {
        sidebar.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
    });
});