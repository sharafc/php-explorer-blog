<?php
/**
 * @file sessionHandler
 * Manages session start and protected URL in one place
 */

// Name and start the session
session_name('blog');
session_start();

// Dashboard is protected -> redirect if not logged in
if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) {
    if (!isset($_SESSION['id'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
