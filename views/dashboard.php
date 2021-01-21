<main>
    <!-- General transaction feedback -->
    <?php if (isset($transactionResultState)) : ?>
        <div class="<?= $transactionResultState["state"] ?> col-100">
            <?= $transactionResultState["message"] ?>
        </div>
    <?php endif ?>

    <!-- Blogpost form -->
    <form action="" method="POST" class="dashboard col-66" enctype="multipart/form-data">
        <input type="hidden" name="addBlogpostSent">
        <fieldset>
            <legend>Add blog entry</legend>

            <label for="headline">Headline</label>
            <?php if (isset($error["headline"])) : ?>
                <div class="error"><?= $error["headline"] ?></div>
            <?php endif ?>
            <input type="text" name="blogentry[headline]" id="headline" value="<?= $blogentry["headline"] ?? "" ?>">

            <label for="category">Category</label>
            <select name="blogentry[category]" id="category">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category["cat_id"] ?>"><?= $category["cat_name"] ?></option>
                <?php endforeach ?>
            </select>

            <label for="">Image</label>
            <?php if (isset($errorImageUpload)) : ?>
                <div class="error"><?= $errorImageUpload ?></div>
            <?php endif ?>
            <div>
                <input type="file" name="image" id="image" class="image-field">
                <select name="blogentry[imageAlignment]" class="image-align">
                    <option value="left">Align left</option>
                    <option value="right">Align right</option>
                </select>
            </div>

            <label for="content">Content</label>
            <?php if (isset($error["content"])) : ?>
                <div class="error"><?= $error["content"] ?></div>
            <?php endif ?>
            <textarea name="blogentry[content]" id="content" cols="30" rows="10"><?= $blogentry["content"] ?? "" ?></textarea>

            <button type="submit">Add blog entry</button>
        </fieldset>
    </form>

    <!-- Category form -->
    <form action="" method="POST" class="dashboard col-33">
        <input type="hidden" name="addCategorySent">
        <fieldset>
            <legend>Add category</legend>
            <?php if (isset($errorMessage)) : ?>
                <div class="error"><?= $errorMessage ?></div>
            <?php endif ?>
            <label for="category">Category name</label>
            <input type="text" name="category" id="category" value="<?= $formCategory ?? "" ?>">
            <button type="submit">Add category</button>
        </fieldset>
    </form>
</main>