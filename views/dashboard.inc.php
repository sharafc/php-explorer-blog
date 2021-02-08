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