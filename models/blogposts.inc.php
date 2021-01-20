<?php

/**
 * Fetches all existing Blog posts
 *
 * @return array $blogPosts all blogposts in the database
 */
function getAllBlogposts() {
    global $pdo;

    $dbQuery = "SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                ORDER BY blog_date DESC";
    $statement = $pdo->prepare($dbQuery);
    $statement->execute();
    if ($statement->errorInfo()[2]) {
        logger("Error while fetching blogposts", $statement->errorInfo()[2]);
    }

    $blogPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $blogPosts;
}

/**
 * Fetches a blogpost by a given $blogpostId
 *
 * @param integer $blogpostId the selected blogpost id
 * @return array $blogPost the blogpost fetched from the database
 */
function getBlogpostById($blogpostId) {
    global $pdo;

    $dbQuery = "SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                WHERE blog_id = :ph_blogId";
    $statement = $pdo->prepare($dbQuery);
    $dbQueryMap = [
        "ph_blogId" => $blogpostId
    ];
    $statement->execute($dbQueryMap);
    if ($statement->errorInfo()[2]) {
        logger("Error while fetching blogpost with ID $blogpostId", $statement->errorInfo()[2]);
    }

    $blogPost = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $blogPost;
}

/**
 * Fetches all blogposts by a given $categoryId
 *
 * @param integer $categoryId the selected category id
 * @return array $blogPosts all blogposts of the given category
 */
function getBlogpostByCategoryId($categoryId)
{
    global $pdo;

    $dbQuery = "SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                WHERE cat_id = :ph_categoryId
                ORDER BY blog_date DESC";
    $statement = $pdo->prepare($dbQuery);
    $dbQueryMap = [
        "ph_categoryId" => $categoryId
    ];
    $statement->execute($dbQueryMap);
    if ($statement->errorInfo()[2]) {
        logger("Error while fetching blogpost with category $categoryId", $statement->errorInfo()[2]);
    }

    $blogPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $blogPosts;
}
