<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
<?php if (!empty($description)): ?>
    <meta name="description" content="<?= $description ?>">
<?php endif; ?>
    <link rel="icon" href="/img/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=IBM+Plex+Sans:ital,wght@0,400;0,700;1,400&family=PT+Serif:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
<?php if (!empty($isHome)): ?>
    <link rel="stylesheet" href="/js/slick/slick.css">
    <link rel="stylesheet" href="/js/slick/slick-theme.css">
<?php endif; ?>
</head>
<body>
