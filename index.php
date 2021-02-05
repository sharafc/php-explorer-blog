<?php
require_once('./include/config.inc.php');
require_once('./include/db.inc.php');
require_once('./include/logger.inc.php');
require_once('./include/form.inc.php');
require_once('./include/dateTime.inc.php');

// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Session handling
session_name('blog');
session_start();

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

// Call Controller
require_once('./controller/index.controller.php');
