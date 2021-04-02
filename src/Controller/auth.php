<?php

require_once(APP_PATH . 'Models/UserInterface.php');
require_once(APP_PATH . 'Models/User.php');

use Models\User;

use Utils\GenericHelper;
use Utils\Forms\Validator;

/**
 * Basic controller for Authentification.
 * Delegates to dashboard view and calls User model
 *
 * @file Controller for Authentification
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */

// Decide with page to link to in meta header, sadly str_contains only works in PHP8
if (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) {
    $linkTarget = [
        'url' => '/home',
        'image' => 'home.svg',
        'title' => 'Home'
    ];
} else {
    $linkTarget = [
        'url' => '/dashboard',
        'image' => 'dashboard.svg',
        'title' => 'Dashboard'
    ];
}

// Handle login and check if account is correct
if (isset($_POST['loginSent'])) {
    $formValidator = new Validator();

    foreach ($_POST['login'] as $key => $value) {
        $login[$key] = GenericHelper::cleanString($value);
    }

    $error = [
        'useremail' => $formValidator->checkEmail($login['useremail']),
        'password' => $formValidator->checkInputString($login['password'], 4)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    if (count($errorMap) === 0) {
        $currentUser = new User();
        $currentUser->setUsr_email($login['useremail']);
        $currentUser->fetchFromDB();

        // Store passwordHash since it is reused and enables easier check
        $passwordHash = $currentUser->getUsr_password();

        if ($passwordHash) {
            if (password_verify($login['password'], $passwordHash)) {
                // Add values to session and redirect to dashboard
                $_SESSION['id'] = $currentUser->getUsr_id();
                $_SESSION['firstname'] = $currentUser->getUsr_firstname();
                $_SESSION['lastname'] = $currentUser->getUsr_lastname();
                header('Location: dashboard');
                exit;
            } else { // Passwords do not match
                $errorLogin = 'Login credentials incorrect.';
            }
        } else { // No User with passwordHash found
            $errorLogin = 'Login credentials incorrect.';
        }
    } else { // Error occured in loginform
        $errorLogin = 'Login credentials incorrect.';
    }
}
