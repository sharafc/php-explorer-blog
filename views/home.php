<?php include_once("./views/partials/main_navigation.php") ?>

<main>
    <?php if ($blogPosts) : ?>
        <?php foreach ($blogPosts as $blogPost) : ?>
            <!-- Blog post -->
            <?php require("./views/partials/blogpost.php") ?>
        <?php endforeach ?>
    <?php else : ?>
        <article>
            <p>No content available</p>
        </article>
    <?php endif ?>
</main>