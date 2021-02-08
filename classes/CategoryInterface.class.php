<?php

/**
 * Undocumented interface
 * @interface
 */
interface CategoryInterface
{
    public function __construct($id, $name);

    public static function fetchAllFromDb(PDO $pdo);
    public function saveCategoryToDb(PDO $pdo);
    public function checkIfCategoryExists(PDO $pdo);

    public function getCat_id();
    public function setCat_id($cat_id);
    public function getCat_name();
    public function setCat_name($cat_name);
}
