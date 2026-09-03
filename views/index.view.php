<?php $title = 'William Stolworthy | Web Developer'; ?>
<?php $description = 'Portfolio of William Stolworthy, a trainee web developer in Norfolk building responsive sites with HTML, CSS, Sass, JavaScript and PHP. Currently enrolled on the Netmatters Scion Coalition Scheme. See my projects and get in touch.'; ?>
<?php $isHome = true; // loads the carousel and typing effect ?>
<?php include __DIR__ . '/partials/head.php'; ?>
    <div id="form-popup" class="form-popup"></div>
<?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div class="header">
        <div class="name">
            <h1>My Name is <span class="title"></span></h1>
            <p><span class="subtitle"></span></p>
        </div>
        <a href="#projects" class="scroll-down">
            Scroll down
            <span class="icon-chevron-down"></span>
        </a>
    </div>
    <div class="project-filters" id="project-filters">
        <button type="button" class="project-filter is-active" data-filter="all">All</button>
        <button type="button" class="project-filter" data-filter="JavaScript">JavaScript</button>
        <button type="button" class="project-filter" data-filter="Python">Python</button>
        <button type="button" class="project-filter" data-filter="HTML/CSS">HTML/CSS</button>
    </div>
    <div class="projects" id="projects">
        <a class="project-item" href="#" data-language="JavaScript">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 1">
            <span class="project-language">JavaScript</span>
            <div class="project-content">
                <h2 class="project-title">Project One</h2>
                <p class="project-description">Project one description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
        <a class="project-item" href="#" data-language="Python">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 2">
            <span class="project-language">Python</span>
            <div class="project-content">
                <h2 class="project-title">Project Two</h2>
                <p class="project-description">Project two description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
        <a class="project-item" href="#" data-language="HTML/CSS">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 3">
            <span class="project-language">HTML/CSS</span>
            <div class="project-content">
                <h2 class="project-title">Project Three</h2>
                <p class="project-description">Project three description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
        <a class="project-item" href="#" data-language="JavaScript">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 4">
            <span class="project-language">JavaScript</span>
            <div class="project-content">
                <h2 class="project-title">Project Four</h2>
                <p class="project-description">Project four description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
        <a class="project-item" href="#" data-language="Python">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 5">
            <span class="project-language">Python</span>
            <div class="project-content">
                <h2 class="project-title">Project Five</h2>
                <p class="project-description">Project five description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
        <a class="project-item" href="#" data-language="HTML/CSS">
            <img class="project-image" src="img/placeholder.png" alt="Screenshot of Project 6">
            <span class="project-language">HTML/CSS</span>
            <div class="project-content">
                <h2 class="project-title">Project Six</h2>
                <p class="project-description">Project six description.</p>
                <span class="project-link">
                    <span class="project-link-text">View Project</span>
                    <span class="icon-arrow-right"></span>
                </span>
            </div>
        </a>
    </div>
    <div class="contact-section" id="contact">
        <div class="contact">
            <div class="contact-details">
                <h2>Get In Touch</h2>
                <p>If you wish to contact me for any reason, please fill out this form.</p>
                <h3 class="contact-details__phone">
                    <button type="button" class="copy-icon" data-copy="07783066519" aria-label="Copy phone number">
                        <span class="icon icon-content_paste"></span>
                        <span class="copy-tooltip">Copied!</span>
                    </button>
                    <a href="tel:07783066519">07783 066519</a>
                </h3>
                <h3 class="contact-details__email">
                    <button type="button" class="copy-icon" data-copy="willstolly@gmail.com" aria-label="Copy email address">
                        <span class="icon icon-content_paste"></span>
                        <span class="copy-tooltip">Copied!</span>
                    </button>
                    <a href="mailto:willstolly@gmail.com">willstolly@gmail.com</a>
                </h3>
                <p>Alternatively contact me via my Email or Mobile Number.</p>
            </div>
            <div class="contact-form">
                <form class="form-grid" id="contact-form" method="post" action="/contact" novalidate>
                    <input type="text" name="first_name" class="form form-first-name required" placeholder="First Name*" maxlength="100">
                    <input type="text" name="last_name" class="form form-last-name required" placeholder="Last Name*" maxlength="100">
                    <input type="email" name="email" class="form form-email required" placeholder="Email Address*" id="email" maxlength="254">
                    <input type="text" name="subject" class="form form-subject" placeholder="Subject" maxlength="150">
                    <textarea name="message" class="form form-message" placeholder="Message" maxlength="5000"></textarea>
                    <button type="submit" class="btn form-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="return">
        <a href="#">Return to Top</a>
    </div>
<?php include __DIR__ . '/partials/footer.php'; ?>
