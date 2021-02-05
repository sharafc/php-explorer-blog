<article>
    <h2><?= $blogPost["blog_headline"] ?></h2>
    <div class="meta">
        <p>Category: <a href="?action=showCategory&id=<?= $blogPost["cat_id"] ?>"><?= $blogPost["cat_name"] ?></a></p>
        <p>Autor: <?= $blogPost["usr_firstname"] ?> <?= $blogPost["usr_lastname"]  ?> from <?= $blogPost["usr_city"] ?></p>
        <p>Publishing date: <?= formattedDate($blogPost["blog_date"]) ?></p>
    </div>
    <?php if (isset($blogPost["blog_imagePath"])) : ?>
        <img src="<?= $blogPost["blog_imagePath"] ?>" class="teaser-image <?= $blogPost["blog_imageAlignment"] ?>" alt="<?= $blogPost["blog_headline"] ?>" title="<?= $blogPost["blog_headline"] ?>">
    <?php endif ?>
    <p><?= nl2br($blogPost["blog_content"]) ?></p>
    <?php if (!isset($blogpostId)) : ?>
        <p class="right"><a href="?action=showBlogpost&blogpostid=<?= $blogPost["blog_id"] ?>">Show detail</a></p>
    <?php endif ?>
</article>