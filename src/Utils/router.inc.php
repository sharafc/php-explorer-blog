<?php

/**
 * Very basic view dispatching mechanism. Checks the defined routes and dispatches to the corresponding
 * controller and view.
 *
 * 1. Initialise controller, action and params
 * 2. Loook for the given value
 * 3. If route exists, load the requested files otherwise dispatch to 404
 *
 * Examples:
 * - /$controller
 * - /$controller/$action
 * - /$controller/$action/$params{0,}
 */

use Utils\DatabaseConnector;

$request = str_replace(DOMAIN_SUB_STRUCTURE, '', $_SERVER['REQUEST_URI']);
$request = trim($request, '/');
$request_parts = explode('/', $request);

$controller = 'home';
if (!empty($request_parts[0])) {
    $controller = $request_parts[0];
}

$action = 'index';
if (!empty($request_parts[1])) {
    $action = $request_parts[1];
}

$params = [];
if (count($request_parts) >= 3) {
    $params = array_slice($request_parts, 2);
}

switch ($controller) {
    case 'home':
        require_once(APP_PATH . 'Controller/home.php');
        require_once(APP_PATH . '../templates/home.php');
        break;
    case 'dashboard':
        require_once(APP_PATH . 'Controller/dashboard.php');
        require_once(APP_PATH . '../templates/dashboard.php');
        break;
    default:
        http_response_code(404);
        require_once(APP_PATH . '../templates/404.php');
        break;
}

