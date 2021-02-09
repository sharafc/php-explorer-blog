<?php

/**
 * Something like a router
 * Delegates to index controller
 *
 * @file Router to index controller
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
require_once('./include/config.inc.php');
require_once('./include/db.inc.php');
require_once('./include/logger.inc.php');
require_once('./include/form.inc.php');
require_once('./include/dateTime.inc.php');

// Call Session Handling
require_once('./include/sessionHandler.inc.php');

// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

$categoryId = NULL;
$blogpostId = NULL;

// Param handling
if (isset($_GET['action'])) {
    $action = cleanString($_GET['action']);

    switch ($action) {
        case 'logout':
            session_destroy();
            header('Location: index.php');
            exit; // Terminating keyword as of PSR-12
        case 'showCategory':
            $categoryId = cleanString($_GET['id']);
            break;
        case 'showBlogpost':
            $blogpostId = cleanString($_GET['blogpostid']);
            break;
    }
}

// Connect to DB
$pdo = dbConnect();

// Call Index Controller
require_once('./controller/index.controller.php');
