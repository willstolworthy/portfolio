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

function validateForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const submitBtn = form.querySelector('.form-submit');

    form.addEventListener('submit', async function(evt) {
        evt.preventDefault();

        const messages = []; // collected so every problem is shown at once

        const requiredFields = document.querySelectorAll('.form.required');
        let requiredTrue = true; // starts as true

        requiredFields.forEach(function (field) {
            if (field.value.trim() === '') { // strips whitespace
                field.style.borderColor = 'red';
                requiredTrue = false;
            } else {
                field.style.borderColor = 'green';
            }
        });

        if (!requiredTrue) { // if NOT true
            messages.push('Please fill out all required fields');
        }

        // checked even when a field above is empty, so both errors can show together
        const emailField = document.getElementById('email');
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (emailField.value.trim() !== '' && !regex.test(emailField.value)) { // returns true if match
            emailField.style.borderColor = 'red';
            messages.push('Please enter a valid email');
        }

        if (messages.length) {
            showPopup(messages.join('\n'), false);
            return; // stop before hitting the server with input it will only reject
        }

        // contact.php validates again
        submitBtn.disabled = true;
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: new FormData(form),
            });
            const result = await response.json();

            showPopup(result.message, result.ok);

            if (result.ok) {
                form.reset();
                // clear the green borders so the blank form doesn't look validated
                document.querySelectorAll('.form').forEach(function (field) {
                    field.style.borderColor = '';
                });
            } else if (result.errors) {
                // the keys match the name attributes, so mark every rejected field at once
                Object.keys(result.errors).forEach(function (name) {
                    const field = form.querySelector('[name="' + name + '"]');
                    if (field) field.style.borderColor = 'red';
                });
            }
        } catch (err) {
            showPopup('Sorry, something went wrong. Please try again.', false);
        } finally {
            submitBtn.disabled = false;
        }
    })
}


validateForm();

// copy to clipboard

document.querySelectorAll('.copy-icon').forEach(function (button) {
    button.addEventListener('click', function () {
        const value = button.dataset.copy;
        const tooltip = button.querySelector('.copy-tooltip');

        navigator.clipboard.writeText(value).then(function () {
            tooltip.classList.add('show');
            setTimeout(function () {
                tooltip.classList.remove('show');
            }, 1500);
        });
    });
});

// carousel

$(document).ready(function(){
    $('.projects').slick({
        dots: true,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1259, // $breakpoint-xlarge (1260px)
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767, // $breakpoint-medium (768px)
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    // project language filter included with slick
    $('.project-filters').on('click', '.project-filter', function () {
        const filter = $(this).data('filter');

        $('.project-filters .project-filter').removeClass('is-active');
        $(this).addClass('is-active');

        // always unfilter back to showing all
        $('.projects').slick('slickUnfilter');

        if (filter !== 'all') {
            $('.projects').slick('slickFilter', '[data-language="' + filter + '"]');
        }
    });
});