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

// Handle login and check if account is correct
if (isset($_POST['loginSent'])) {

    foreach ($_POST['login'] as $key => $value) {
        $login[$key] = cleanString($value);
    }

    $error = [
        'useremail' => checkEmail($login['useremail']),
        'password' => checkInputString($login['password'], 4)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    if (count($errorMap) === 0) {
        // Initialise empty User, assign email to it and fill it up with data from the database
        $currentUser = new User();
        $currentUser->setUsr_email($login['useremail']);
        $currentUser = $currentUser->fetchFromDB($pdo);

        // Store password since it is reused and enables easier check
        $password  = $currentUser->getUsr_password();

        if ($password) {
            if (password_verify($login['password'], $password)) {
                // Add values to session and redirect to dashboard
                $_SESSION['id'] = $currentUser->getUsr_id();
                $_SESSION['firstname'] = $currentUser->getUsr_firstname();
                $_SESSION['lastname'] = $currentUser->getUsr_lastname();
                header('Location: dashboard.php');
                exit;
            } else { // Passwords do not match
                $errorLogin = 'Login credentials incorrect.';
            }
        } else { // No User with password found
            $errorLogin = 'Login credentials incorrect.';
        }
    } else { // Error occured in loginform
        $errorLogin = 'Login credentials incorrect.';
    }
}

// Fetch all categories for navigation
$categories = Category::fetchAllFromDb($pdo);

// Fetch all blogposts
$blogPosts = Blog::fetchPostsFromDb($pdo, $categoryId, $blogpostId);

// Delegate view
require_once('./views/index.inc.php');
