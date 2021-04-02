<?php
// Create session
session_name('blog');
session_start();

// Request destructing needed, since localhost doesn't give the correct root
$request = str_replace(DOMAIN_SUB_STRUCTURE, '', $_SERVER['REQUEST_URI']);
$request = trim($request, '/');

// Dashboard is protected -> redirect if not logged in
if ($request == 'dashboard') {
    if (!isset($_SESSION['id'])) {
        session_destroy();
        header('Location: /home');
        exit;
    }
}
