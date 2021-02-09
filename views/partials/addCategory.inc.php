<form action="" method="POST" class="dashboard col-33">
    <input type="hidden" name="addCategorySent">
    <fieldset>
        <legend>Add category</legend>
        <?php if (isset($errorMessage)) : ?>
            <div class="error"><?= $errorMessage ?></div>
        <?php endif ?>
        <label for="category">Category name</label>
        <input type="text" name="category" id="category" value="<?= $formCategory ?? '' ?>">
        <button type="submit">Add category</button>
    </fieldset>
</form>