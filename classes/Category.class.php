<?php

/**
 * Undocumented class
 */
class Category implements CategoryInterface
{
    private $cat_id;
    private $cat_label;

    public function __construct()
    {
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @return array
     */
    public function fetchAllFromDb(PDO $pdo)
    {
        $statement = $pdo->prepare('SELECT * from category');
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($statement->errorInfo()[2]) {
            logger('Could not fetch categories from database', $statement->errorInfo()[2]);
        }

        return $categories;
    }

    public function saveCategoryToDb(PDO $pdo)
    {
    }

    public function checkIfCategoryExists(PDO $pdo)
    {
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
     * Get the value of cat_label
     */
    public function getCat_label()
    {
        return $this->cat_label;
    }

    /**
     * Set the value of cat_label
     *
     * @return  self
     */
    public function setCat_label($cat_label)
    {
        $this->cat_label = $cat_label;

        return $this;
    }
}
