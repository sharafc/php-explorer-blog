<?php
// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Param handling
switch ($action) {
    case "logout":
        session_destroy();
        header("Location: /home");
        exit; // Terminating keyword as of PSR-12
    case "showCategory":
        $categoryId = cleanString($params[0]);
        break;
    case "showBlogpost":
        $blogpostId = cleanString($params[0]);
        break;
}

// Connect to DB
$pdo = dbConnect();

// Fetch all categories for navigation
$statement = $pdo->prepare("SELECT * from categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
if ($statement->errorInfo()[2]) {
    logger("Error while fetching categories", $statement->errorInfo()[2]);
}

/*
 * Fetch blogposts
 * -> If category is set via action, only select blogposts from this category
 * -> if blogId is set via action, only select this blogpost to display
 */
$dbQuery = "SELECT * FROM blogs INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)"
    . (isset($categoryId) ? " WHERE cat_id = :ph_categoryId" : "")
    . (isset($blogpostId) ? " WHERE blog_id = :ph_blogId" : "")
    . " ORDER BY blog_date DESC";
$statement = $pdo->prepare($dbQuery);

// Execute query with map, depending on selected action
if (isset($categoryId)) {
    $dbQueryMap = [
        "ph_categoryId" => $categoryId
    ];
    $statement->execute($dbQueryMap);
} elseif (isset($blogpostId)) {
    $dbQueryMap = [
        "ph_blogId" => $blogpostId
    ];
    $statement->execute($dbQueryMap);

    // Fallback for navigation
    $categoryId = NULL;
} else {
    $statement->execute();

    // Fallback for navigation
    $categoryId = NULL;
}

$blogPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
if ($statement->errorInfo()[2]) {
    logger("Error while fetching blogposts", $statement->errorInfo()[2]);
}
