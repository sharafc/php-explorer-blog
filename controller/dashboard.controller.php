<?php

/**
 * Basic controller for Dashboard.
 * Delegates to dashboard view and calls Category, User and Blog model
 *
 * @file Controller for Dashboard-Page
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

// Fetch all categories for blogpost form
$categories = Category::fetchAllFromDb($pdo);

// Handle add category form
if (isset($_POST['addCategorySent'])) {
    // Escape field value and check for validity
    $formCategory = cleanString($_POST['category']);
    $errorMessage = checkInputString($formCategory);

    if (!$errorMessage) {  // No errors
        // Initialise Category object
        $newCategory = new Category(NULL, $formCategory);

        if (!$newCategory->checkIfCategoryExists($pdo)) { // No entry found, save to db
            if ($newCategory->saveCategoryToDb($pdo)) { // INSERT successfull
                $transactionResultState = [
                    'state' => 'success',
                    'message' => 'Category ' . $newCategory->getCat_name() . ' saved to database with ID: ' . $newCategory->getCat_id()
                ];

                // Empty form field
                $formCategory = NULL;
            } else { // INSERT went wrong
                $transactionResultState = [
                    'state' => 'error',
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }
        } else { // Category already exists
            $errorMessage = 'Category ' . $newCategory->getCat_name() . ' already exists.';
        }
    }
}

// Handle add blogpost form
if (isset($_POST['addBlogpostSent'])) {
    // Clean post array values of potential risks
    foreach ($_POST['blogentry'] as $key => $value) {
        $blogentry[$key] = cleanString($value);
    }

    // Validate fields and assign errors
    $error = [
        'headline' => checkInputString($blogentry['headline']),
        'content' => checkInputString($blogentry['content'], 200, 40000)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    // Triple operator check since we really want to check on int 0 since the count returns an integer
    if (count($errorMap) === 0) { // No errors
        // Form has no field errors, handle image if exists
        if ($_FILES['image']['tmp_name']) {
            $imageUpload = uploadImage($_FILES['image']);
        } else {
            $imageUpload = NULL;
        }

        if (isset($imageUpload['error'])) { // Upload or image validation failed
            $errorImageUpload = $imageUpload['error'];
        } else { // Upload successfull or no image given -> process form

            $currentUser = new User();
            $currentUser->setUsr_id(cleanString($_SESSION["id"]));

            // Initialise Blog object
            $newBlogpost = new Blog(
                $blogentry['headline'],
                $blogentry['content'],
                new Category($blogentry['category']),
                $currentUser,
                $blogentry['imageAlignment'],
                $imageUpload['path']
            );

            if ($newBlogpost->savePostToDb($pdo)) { // INSERT successfull
                $transactionResultState = [
                    'state' => 'success',
                    'message' => 'Blogpost with ID ' . $newBlogpost->getBlog_id() . 'saved to database.'
                ];

                // Clear form fields
                $blogentry = [];
            } else { // INSERT failed
                $transactionResultState = [
                    'state' => 'error',
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }
        }
    }
}

// Delegate view
require_once('./views/dashboard.inc.php');
