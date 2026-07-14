// typing effect

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

// hamburger menu sidebar

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

// form validation - replaces required html tag

function showPopup(message, isValid) {
  const popup = document.getElementById('form-popup');
  popup.textContent = message;
  popup.className = 'form-popup show ' + (isValid ? 'success' : 'error');

  setTimeout(() => {
    popup.className = 'form-popup'; // resets to hidden
  }, 3000);
}

function validateEmail() {
    document.querySelector('.form-submit').addEventListener('click', function(evt) {
        const emailInput = document.getElementById('email').value;
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (regex.test(emailInput)) { // returns true if match
            evt.preventDefault();
            document.getElementById('email').style.borderColor = 'green';
            showPopup('Valid email!', true);
        } else {
            evt.preventDefault();
            document.getElementById('email').style.borderColor = 'red';
            showPopup('Please enter a valid email', false);
        }
    })  
}

validateEmail();