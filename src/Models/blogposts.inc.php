<?php

/**
 * Fetches all existing Blog posts
 *
 * @return array $blogPosts all blogposts in the database
 */
function getAllBlogposts() {
    global $pdo;

    $dbQuery = 'SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                ORDER BY blog_date DESC';
    $statement = $pdo->prepare($dbQuery);
    $statement->execute();
    if ($statement->errorInfo()[2]) {
        logger('Error while fetching blogposts', $statement->errorInfo()[2]);
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

    $dbQuery = 'SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                WHERE blog_id = :ph_blogId';
    $statement = $pdo->prepare($dbQuery);
    $dbQueryMap = [
        'ph_blogId' => $blogpostId
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

    $dbQuery = 'SELECT * FROM blogs
                INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)
                WHERE cat_id = :ph_categoryId
                ORDER BY blog_date DESC';
    $statement = $pdo->prepare($dbQuery);
    $dbQueryMap = [
        'ph_categoryId' => $categoryId
    ];
    $statement->execute($dbQueryMap);
    if ($statement->errorInfo()[2]) {
        logger("Error while fetching blogpost with category $categoryId", $statement->errorInfo()[2]);
    }

    $blogPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $blogPosts;
}

/**
 * Inserts a blogpost into the database
 *
 * @param array $blogentry Array containing all the form values
 * @param string|null $imagePath Path to the uploaded image or null if no image was uploaded
 * @return integer The number of inserted datasets
 */
function insertBlogpost($blogentry, $imagePath){
    global $pdo;

    $sqlQuery = 'INSERT INTO blogs (blog_headline, blog_imagePath, blog_imageAlignment, blog_content, cat_id, usr_id)
                 VALUES (:ph_headline, :ph_imagepath, :ph_alignment, :ph_content, :ph_category, :ph_userid)';
    $sqlQueryMap = [
        'ph_headline' => $blogentry['headline'],
        'ph_imagepath' => $imagePath,
        'ph_alignment' => $blogentry['imageAlignment'],
        'ph_content' => $blogentry['content'],
        'ph_category' => $blogentry['category'],
        'ph_userid' => cleanString($_SESSION['id'])
    ];

    $statement = $pdo->prepare($sqlQuery);
    $statement->execute($sqlQueryMap);
    $rowCount = $statement->rowCount();
    if ($statement->errorInfo()[2]) {
        logger('Error while inserting into blogs', $statement->errorInfo()[2]);
    }

    return $rowCount;
}