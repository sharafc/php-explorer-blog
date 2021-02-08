<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/debug.css">
</head>

<body>
    <?php require_once('./views/partials/header.php') ?>
    <?php require_once('./views/partials/navigation.php') ?>

    <main>
        <?php if ($blogPosts) : ?>
            <?php foreach ($blogPosts as $blogPost) : ?>
                <!-- Blog post -->
                <?php require('./views/partials/blogpost.php') ?>
            <?php endforeach ?>
        <?php else : ?>
            <article>
                <p>No content available</p>
            </article>
        <?php endif ?>
    </main>

    <?php require_once('./views/partials/footer.php') ?>
</body>

</html>