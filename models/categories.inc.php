<?php

/**
 * Fetches all categories from the database
 *
 * @return array $categories all categories stored in the database
 */
function getAllCategories()
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * from categories');
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($statement->errorInfo()[2]) {
        logger('Error while fetching categories', $statement->errorInfo()[2]);
    }

    return $categories;
}

/**
 * Counts the occurance of a given category in the database
 *
 * @param string $categoryName The name of the category to count
 * @return integer $count The number of categories found
 */
function countCategoriesByName($categoryName)
{
    global $pdo;
    $statement = $pdo->prepare('SELECT COUNT(cat_name) FROM categories WHERE cat_name = :ph_category_name');
    $statement->execute([
        'ph_category_name' => $categoryName
    ]);
    $count = $statement->fetchColumn();
    if ($statement->errorInfo()[2]) {
        logger('Error while fetching category', $statement->errorInfo()[2]);
    }

    return $count;
}

/**
 * Inserts a new category with given name into the database
 *
 * @param string $categoryName
 * @return integer $count The number of datasets inserted
 */
function insertCategoryByName($categoryName) {
    global $pdo;
    $statement = $pdo->prepare('INSERT INTO categories (cat_name) VALUES (:ph_category_name)');
    $statement->execute([
        'ph_category_name' => $categoryName
    ]);
    $categoryRowCount = $statement->rowCount();
    if ($statement->errorInfo()[2]) {
        logger('Error while inserting category', $statement->errorInfo()[2]);
    }

    return $categoryRowCount;
}