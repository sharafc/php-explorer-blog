<?php

/**
 * Basic view for Index
 * Is called by Index Controller
 * Aggregates needed partials:
 *      - Header
 *      - Navigation
 *      - Blogpost
 *      - Footer
 *
 * @file View for Index-Page
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/debug.css">
</head>

<body>
    <?php require_once('./views/partials/header.inc.php') ?>
    <?php require_once('./views/partials/navigation.inc.php') ?>

    <main>
        <?php if ($blogPosts) : ?>
            <?php foreach ($blogPosts as $blogPost) : ?>
                <!-- Blog post -->
                <?php require('./views/partials/blogpost.inc.php') ?>
            <?php endforeach ?>
        <?php else : ?>
            <article>
                <p>No content available</p>
            </article>
        <?php endif ?>
    </main>

    <?php require_once('./views/partials/footer.inc.php') ?>
</body>

</html>