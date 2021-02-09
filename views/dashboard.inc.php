<?php
/**
 * Basic view for Dashboard
 * Is called by Dashboard Controller
 * Aggregates needed partials:
 *      - Header
 *      - addBlogpost and addCategory forms
 *      - Footer
 *
 * @file View for Dashboard-Page
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Dashboard</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/debug.css">
</head>

<body>
    <?php require_once('./views/partials/header.php') ?>

    <main>
        <!-- General transaction feedback -->
        <?php if (isset($transactionResultState)) : ?>
            <div class="<?= $transactionResultState['state'] ?> col-100">
                <?= $transactionResultState['message'] ?>
            </div>
        <?php endif ?>

        <!-- Blogpost form -->
        <?php require_once('./views/partials/addBlogpost.php'); ?>

        <!-- Category form -->
        <?php require_once('./views/partials/addCategory.php'); ?>
    </main>

    <?php require_once('./views/partials/footer.php') ?>
</body>

</html>