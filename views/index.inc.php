<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/debug.css">
</head>

<body>
    <?php include_once("./views/partials/header.php") ?>

    <nav>
        <span><a href="index.php" class="<?= !$categoryId ? "active" : ""  ?>">Home</a></span>
        <?php if ($categories) : ?>
            <?php foreach ($categories as $category) : ?>
                <span>
                    <a href="?action=showCategory&id=<?= $category["cat_id"] ?>" class="<?= $category["cat_id"] == $categoryId ? "active" : ""  ?>"><?= $category["cat_name"] ?></a>
                </span>
            <?php endforeach ?>
        <?php endif ?>
    </nav>

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

    <?php include_once("./views/partials/footer.php") ?>
</body>

</html>