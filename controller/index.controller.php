<?php

/**
 * Basic controller for Index.
 * Delegates to index view and calls Category, User and Blog model
 *
 * @file Controller for Index-Page
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
require_once('./classes/CategoryInterface.class.php');
require_once('./classes/Category.class.php');
require_once('./classes/UserInterface.class.php');
require_once('./classes/User.class.php');
require_once('./classes/BlogInterface.class.php');
require_once('./classes/Blog.class.php');

// Fetch all categories for navigation
$categories = Category::fetchAllFromDb($pdo);

// Fetch all blogposts
$blogPosts = Blog::fetchPostsFromDb($pdo, $categoryId, $blogpostId);

// Delegate view
require_once('./views/index.inc.php');
