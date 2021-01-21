<nav>
    <span><a href="/home" class="<?= !$categoryId ? "active" : ""  ?>">Home</a></span>
    <?php if ($categories) : ?>
        <?php foreach ($categories as $category) : ?>
            <span>
                <a href="/home/showCategory/<?= $category["cat_id"] ?>" class="<?= $category["cat_id"] == $categoryId ? "active" : ""  ?>"><?= $category["cat_name"] ?></a>
            </span>
        <?php endforeach ?>
    <?php endif ?>
</nav>