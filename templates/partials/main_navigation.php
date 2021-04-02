<nav>
    <span><a href="/home" class="<?= !$categoryId ? 'active' : ''  ?>">Home</a></span>
    <?php if ($categories) : ?>
        <?php foreach ($categories as $category) : ?>
            <span>
                <a href="/home/showCategory/<?= $category->getCat_id() ?>" class="<?= $category->getCat_id() == $categoryId ? 'active' : ''  ?>"><?= $category->getCat_name() ?></a>
            </span>
        <?php endforeach ?>
    <?php endif ?>
</nav>