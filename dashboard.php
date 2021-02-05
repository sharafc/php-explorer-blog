<?php
require_once('./include/config.inc.php');
require_once('./include/db.inc.php');
require_once('./include/logger.inc.php');
require_once('./include/form.inc.php');
require_once('./include/uploadImage.inc.php');

// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Session handling
session_name('blog');
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Connect to DB
$pdo = dbConnect();

// Call Controller
require_once('./controller/dashboard.controller.php');
