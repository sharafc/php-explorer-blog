<?php

/**
 * Something like a router
 * Sets up configuration and helper functions
 * Delegates to dashboard controller
 *
 * @file "Router" to dashboard controller
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
require_once('./include/config.inc.php');
require_once('./include/db.inc.php');
require_once('./include/logger.inc.php');
require_once('./include/form.inc.php');
require_once('./include/uploadImage.inc.php');

// Call Session Handling
require_once('./include/sessionHandler.inc.php');

// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Connect to DB
$pdo = dbConnect();

// Call Dashboard Controller
require_once('./controller/dashboard.controller.php');
