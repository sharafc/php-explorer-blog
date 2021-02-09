<article>
    <h2><?= $blogPost->getBlog_headline() ?></h2>
    <div class="meta">
        <p>Category: <a href="?action=showCategory&id=<?= $blogPost->getCategory()->getCat_id(); ?>"><?= $blogPost->getCategory()->getCat_name(); ?></a></p>
        <p>Autor: <?= $blogPost->getUser()->getUsr_firstname() ?> <?= $blogPost->getUser()->getUsr_lastname()  ?> from <?= $blogPost->getUser()->getUsr_city() ?></p>
        <p>Publishing date: <?= formattedDate($blogPost->getBlog_date()) ?></p>
    </div>
    <?php if ($blogPost->getBlog_imagePath()) : ?>
        <img src="<?= $blogPost->getBlog_imagePath() ?>" class="teaser-image <?= $blogPost->getBlog_imageAlignment() ?>" alt="<?= $blogPost->getBlog_headline() ?>" title="<?= $blogPost->getBlog_headline() ?>">
    <?php endif ?>
    <p><?= nl2br($blogPost->getBlog_content()) ?></p>
    <?php if (!isset($blogpostId)) : ?>
        <p class="right"><a href="?action=showBlogpost&blogpostid=<?= $blogPost->getBlog_id() ?>">Show detail</a></p>
    <?php endif ?>
</article>