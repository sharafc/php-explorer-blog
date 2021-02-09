<?php

/**
 * Represents a blogposts Category with all its entities
 * Is also used to build up navigation items.
 *
 * @implements CategoryInterface
 *
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
class Category implements CategoryInterface
{
    private $cat_id;
    private $cat_name;

    /**
     * @construct
     *
     * @param integer $id The category id
     * @param string $name The name of the category
     */
    public function __construct($id = NULL, $name = NULL)
    {
        $this->setCat_id($id);
        $this->setCat_name($name);
    }

    /**
     * Fetches categories from the database.
     *
     * @param PDO $pdo The PHP database object
     * @return array $categories Array containing Category objects which represent our categories
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
     * Save a category to the database
     *
     * @param PDO $pdo The PHP database object
     * @return bool True when saving was successful, otherwise false
     */
    public function saveCategoryToDb(PDO $pdo)
    {
        $statement = $pdo->prepare('INSERT INTO category (cat_name) VALUES (:ph_category_name)');

        $statement->execute([
            'ph_category_name' => $this->getCat_name()
        ]);

        if ($statement->errorInfo()[2]) {
            logger('Could not save category ' . $this->getCat_name() . ' to database', $statement->errorInfo()[2]);
        }

        $rowCount = $statement->rowCount();
        if ($rowCount) {
            $lastInsertId = $pdo->lastInsertId();
            $this->setCat_id($lastInsertId);
            logger('Saving successful. Category saved with ID: ', $lastInsertId, LOGGER_INFO);

            return true;
        }

        return false;
    }

    /**
     * Check if a category already exists in the database
     *
     * @param PDO $pdo The PHP database object
     * @return bool True when category exists, otherwise false
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
     */
    public function setCat_id($cat_id)
    {
        $this->cat_id = $cat_id;
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
     */
    public function setCat_name($cat_name)
    {
        $this->cat_name = $cat_name;
    }
}
