<?php
require_once('./classes/CategoryInterface.class.php');
require_once('./classes/Category.class.php');
require_once('./classes/UserInterface.class.php');
require_once('./classes/User.class.php');
require_once('./classes/BlogInterface.class.php');
require_once('./classes/Blog.class.php');

// Fetch all categories for navigation
$categories = Category::fetchAllFromDb($pdo);
$blogPosts = Blog::fetchPostsFromDb($pdo, $categoryId, $blogpostId);

// Delegate view
require_once('./views/index.inc.php');
