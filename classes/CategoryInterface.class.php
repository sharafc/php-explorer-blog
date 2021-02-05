<?php

/**
 * Undocumented interface
 * @interface
 */
interface CategoryInterface
{
    public function __construct();

    public function fetchAllFromDb(PDO $pdo);
    public function saveCategoryToDb(PDO $pdo);
    public function checkIfCategoryExists(PDO $pdo);

    public function getCat_id();
    public function setCat_id($cat_id);
    public function getCat_label();
    public function setCat_label($cat_label);
}
