    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<?php if (!empty($isHome)): ?>
    <script src="https://unpkg.com/typeit@8.8.7/dist/index.umd.js"></script>
    <script>
        // jQuery 4.0 removed $.type(), which the unmaintained Slick carousel still calls internally. had to use ai to fix
        if (!$.type) {
            $.type = function (obj) {
                if (obj == null) return obj + '';
                return typeof obj === 'object' || typeof obj === 'function'
                    ? (Object.prototype.toString.call(obj).match(/^\[object (.+)\]$/)[1].toLowerCase())
                    : typeof obj;
            };
        }
    </script>
    <script src="/js/slick/slick.min.js"></script>
<?php endif; ?>
    <script src="/js/main.js"></script>
</body>
</html>
