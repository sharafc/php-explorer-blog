<?php

namespace Models;

use PDO;

/**
 * Describes a category
 */
interface CategoryInterface
{
    public function __construct($id, $name);

    public static function fetchAllFromDb();

    public function saveCategoryToDb();
    public function checkIfCategoryExists();

    public function getCat_id();
    public function setCat_id($cat_id);
    public function getCat_name();
    public function setCat_name($cat_name);
    public function getDbConnection();
    public function setDbConnection(PDO $connection);
}
