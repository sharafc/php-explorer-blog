<?php
/**
 * Fetches all categories from the database
 *
 * @return array $categories all categories stored in the database
 */
function getAllCategories()
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * from categories");
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($statement->errorInfo()[2]) {
        logger("Error while fetching categories", $statement->errorInfo()[2]);
    }

    return $categories;
}
