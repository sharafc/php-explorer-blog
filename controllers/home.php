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
$dbQuery = "SELECT * FROM blogs INNER JOIN users USING(usr_id) INNER JOIN categories USING(cat_id)"
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
