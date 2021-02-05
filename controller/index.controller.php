<?php

// Fetch all categories for navigation
$statement = $pdo->prepare("SELECT * from category");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
if (DEBUG) {
    echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching categories for navigation... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
}
if (DEBUG_DB) {
    if ($statement->errorInfo()[2]) {
        echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }
}
if (DEBUG_ARRAY) {
    echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
    print_r($categories);
    echo "</pre>";
}

/*
* Fetch blogposts
* -> If category is set via action, only select blogposts from this category
* -> if blogId is set via action, only select this blogpost to display
*/
$dbQuery = "SELECT * FROM blog INNER JOIN user USING(usr_id) INNER JOIN category USING(cat_id)"
    . (isset($categoryId) ? " WHERE cat_id = :ph_categoryId" : "")
    . (isset($blogpostId) ? " WHERE blog_id = :ph_blogId" : "")
    . " ORDER BY blog_date DESC";
$statement = $pdo->prepare($dbQuery);
if (DEBUG) {
    echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$dbQuery: $dbQuery <i>(" . basename(__FILE__) . ")</i></p>\r\n";
}

// Execute query with map, depending on selected action
if (isset($categoryId)) {
    $dbQueryMap = [
        "ph_categoryId" => $categoryId
    ];
    if (DEBUG_ARRAY) {
        echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
        print_r($dbQueryMap);
        echo "</pre>";
    }

    $statement->execute($dbQueryMap);
    if (DEBUG) {
        echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching blogposts with category $categoryId... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }
} elseif (isset($blogpostId)) {
    $dbQueryMap = [
        "ph_blogId" => $blogpostId
    ];
    if (DEBUG_ARRAY) {
        echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
        print_r($dbQueryMap);
        echo "</pre>";
    }

    $statement->execute($dbQueryMap);
    if (DEBUG) {
        echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching blogpost with id $blogpostId... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }

    // Fallback for navigation
    $categoryId = NULL;
} else {
    $statement->execute();
    if (DEBUG) {
        echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching all blogposts ... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }

    // Fallback for navigation
    $categoryId = NULL;
}

$blogPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
if (DEBUG_DB) {
    if ($statement->errorInfo()[2]) {
        echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }
}
if (DEBUG_ARRAY) {
    echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
    print_r($blogPosts);
    echo "</pre>";
}

// Delegate view
require_once('./views/index.inc.php');
