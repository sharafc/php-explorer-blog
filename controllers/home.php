<?php
require_once('./models/categories.inc.php');
require_once('./models/blogposts.inc.php');

$categoryId = NULL;
$blogpostId = NULL;

// Param handling
switch ($action) {
    case 'logout':
        session_destroy();
        header('Location: /home');
        exit; // Terminating keyword as of PSR-12
    case 'showCategory':
        $categoryId = cleanString($params[0]);
        break;
    case 'showBlogpost':
        $blogpostId = cleanString($params[0]);
        break;
}

// Fetch all categories for navigation
// TODO: Try/Catch
$categories = getAllCategories();

/*
 * Fetch blogposts
 * -> If category is set via action, only select blogposts from this category
 * -> if blogId is set via action, only select this blogpost to display
 */
if (isset($categoryId)) {
    $blogPosts = getBlogpostByCategoryId($categoryId);
} elseif (isset($blogpostId)) {
    $blogPosts = getBlogpostById($blogpostId);
} else {
    $blogPosts = getAllBlogposts($categoryId, $blogpostId);
}
