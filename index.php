<?php
require_once("./include/config.inc.php");
require_once("./include/db.inc.php");
require_once("./include/form.inc.php");
require_once("./include/dateTime.inc.php");

// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Session handling
session_name("blog");
session_start();

// Param handling
if (isset($_GET["action"])) {
    $action = cleanString($_GET["action"]);

    switch ($action) {
        case "logout":
            session_destroy();
            header("Location: index.php");
            exit; // Terminating keyword as of PSR-12
        case "showCategory":
            $categoryId = cleanString($_GET["id"]);
            break;
        case "showBlogpost":
            $blogpostId = cleanString($_GET["blogpostid"]);
            break;
    }
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
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/debug.css">
</head>

<body>
    <?php include_once("./header.php") ?>

    <nav>
        <span><a href="index.php" class="<?= !$categoryId ? "active" : ""  ?>">Home</a></span>
        <?php if ($categories) : ?>
            <?php foreach ($categories as $category) : ?>
                <span>
                    <a href="?action=showCategory&id=<?= $category["cat_id"] ?>" class="<?= $category["cat_id"] == $categoryId ? "active" : ""  ?>"><?= $category["cat_name"] ?></a>
                </span>
            <?php endforeach ?>
        <?php endif ?>
    </nav>

    <main>
        <?php if ($blogPosts) : ?>
            <?php foreach ($blogPosts as $blogPost) : ?>
                <!-- Blog post -->
                <article>
                    <h2><?= $blogPost["blog_headline"] ?></h2>
                    <div class="meta">
                        <p>Category: <a href="?action=showCategory&id=<?= $blogPost["cat_id"] ?>"><?= $blogPost["cat_name"] ?></a></p>
                        <p>Autor: <?= $blogPost["usr_firstname"] ?> <?= $blogPost["usr_lastname"]  ?> from <?= $blogPost["usr_city"] ?></p>
                        <p>Publishing date: <?= formattedDate($blogPost["blog_date"]) ?></p>
                    </div>
                    <?php if (isset($blogPost["blog_imagePath"])) : ?>
                        <img src="<?= $blogPost["blog_imagePath"] ?>" class="teaser-image <?= $blogPost["blog_imageAlignment"] ?>" alt="<?= $blogPost["blog_headline"] ?>" title="<?= $blogPost["blog_headline"] ?>">
                    <?php endif ?>
                    <p><?= nl2br($blogPost["blog_content"]) ?></p>
                    <?php if (!isset($blogpostId)) : ?>
                        <p class="right"><a href="?action=showBlogpost&blogpostid=<?= $blogPost["blog_id"] ?>">Show detail</a></p>
                    <?php endif ?>
                </article>
            <?php endforeach ?>
        <?php else : ?>
            <article>
                <p>No content available</p>
            </article>
        <?php endif ?>
    </main>

    <?php include_once("./footer.php") ?>
</body>

</html>