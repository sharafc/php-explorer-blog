<?php

use Models\Category;
use Models\Blog;

/**
 * Basic controller for Home.
 * Delegates to home view and calls Category, User and Blog model
 *
 * @file Controller for Home-Page
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */

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
$categories = Category::fetchAllFromDb($pdo);

/*
 * Fetch blogposts
 * -> If category is set via action, only select blogposts from this category
 * -> if blogId is set via action, only select this blogpost to display
 */
$blogPosts = Blog::fetchPostsFromDb($pdo, $categoryId, $blogpostId);

