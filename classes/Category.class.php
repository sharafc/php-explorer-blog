<?php

/**
 * Undocumented class
 */
class Category implements CategoryInterface
{
    private $cat_id;
    private $cat_name;

    public function __construct($id, $name)
    {
        $this->setCat_id($id);
        $this->setCat_name($name);
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @return array
     */
    public static function fetchAllFromDb(PDO $pdo)
    {
        $statement = $pdo->prepare('SELECT * from category');
        $statement->execute();

        if ($statement->errorInfo()[2]) {
            logger('Could not fetch categories from database', $statement->errorInfo()[2]);
        }

        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category(
                $result['cat_id'],
                $result['cat_name']
            );
        }

        return $categories;
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @return void
     */
    public function saveCategoryToDb(PDO $pdo)
    {
        $statement = $pdo->prepare('INSERT INTO category (cat_name) VALUES (:ph_category_name)');
        $statement->execute([
            'ph_category_name' => $this->getcat_name()
        ]);
        if ($statement->errorInfo()[2]) {
            logger('Could not save category ' . $this->getcat_name() . ' to database', $statement->errorInfo()[2]);
        }

        $categoryRowCount = $statement->rowCount();
        if ($categoryRowCount) {
            return true;
        }
        return false;
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @return void
     */
    public function checkIfCategoryExists(PDO $pdo)
    {
        $statement = $pdo->prepare('SELECT COUNT(cat_name) FROM category WHERE cat_name = :ph_category_name');
        $statement->execute([
            'ph_category_name' => $this->getcat_name()
        ]);
        $count = $statement->fetchColumn();
        if ($statement->errorInfo()[2]) {
            logger('Could not execute category check', $statement->errorInfo()[2]);
        }

        if ($count) {
            return true;
        }
        return false;
    }


    /**
     * Get the value of cat_id
     */
    public function getCat_id()
    {
        return $this->cat_id;
    }

    /**
     * Set the value of cat_id
     *
     * @return  self
     */
    public function setCat_id($cat_id)
    {
        $this->cat_id = $cat_id;

        return $this;
    }

    /**
     * Get the value of cat_name
     */
    public function getCat_name()
    {
        return $this->cat_name;
    }

    /**
     * Set the value of cat_name
     *
     * @return  self
     */
    public function setCat_name($cat_name)
    {
        $this->cat_name = $cat_name;

        return $this;
    }
}
