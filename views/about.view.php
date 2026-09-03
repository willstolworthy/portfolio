<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="icon" href="img/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=IBM+Plex+Sans:ital,wght@0,400;0,700;1,400&family=PT+Serif:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <button type="button" class="hamburger" aria-label="Toggle sidebar" aria-expanded="false" aria-controls="sidebar">
        <span class="icon-menu1"></span>
    </button>
    <div class="sidebar">
        <h1 class="logo"><a href="/">WS</a></h1>
        <nav class="sidebar-nav">
            <h4>Navigation</h4>
            <a href="#">About Me</a>
            <a href="/#projects">My Portfolio</a>
            <a href="/coding">Coding Examples</a>
            <a href="/scs">SCS Scheme</a>
            <h4 class="contact-heading"><a href="/#contact">Contact Me</a></h4>
            <div class="socials">
                <a href="https://github.com/willstolworthy" target="_blank" class="social-link" aria-label="GitHub">
                    <span class="icon-github"></span>
                </a>
                <a href="tel:#" class="social-link" aria-label="Phone">
                    <span class="icon-phone1"></span>
                </a>
                <a href="mailto:#" class="social-link" aria-label="Email">
                    <span class="icon-email"></span>
                </a>
            </div>
        </nav>
    </div>
    <div class="about">
        <div class="about-me">
            <h1>About Me</h1>
            <p>My name is William Stolworthy and I am a trainee Web Developer that is currently studying on the Netmatters Scion Coalition Scheme.</p>
            <h2>Skills</h2>
            <ul>
                <li>HTML</li>
                <li>CSS</li>
                <li>Sass</li>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>