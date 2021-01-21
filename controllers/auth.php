<?php
require_once("./models/auth.inc.php");

// Decide with page to link to in meta header, sadly str_contains only works in PHP8
if (strpos($_SERVER["REQUEST_URI"], "dashboard") !== false) {
    $linkTarget = [
        "url" => "/home",
        "image" => "home.svg",
        "title" => "Home"
    ];
} else {
    $linkTarget = [
        "url" => "/dashboard",
        "image" => "dashboard.svg",
        "title" => "Dashboard"
    ];
}

// Handle login and check if account is correct
if (isset($_POST["loginSent"])) {

    foreach ($_POST["login"] as $key => $value) {
        $login[$key] = cleanString($value);
    }

    $error = [
        "useremail" => checkEmail($login["useremail"]),
        "password" => checkInputString($login["password"], 4)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    if (count($errorMap) === 0) {
        $user = getUserByMail($login["useremail"]);

        if ($user) {
            if (password_verify($login["password"], $user["usr_password"])) {
                // Add values to session and redirect to dashboard
                $_SESSION["id"] = $user["usr_id"];
                $_SESSION["firstname"] = $user["usr_firstname"];
                $_SESSION["lastname"] = $user["usr_lastname"];
                header("Location: /dashboard");
                //session_regenerate_id();
                exit;
            } else { // Passwords do not match
                $errorLogin = "Login credentials incorrect.";
            }
        }
    } else { // Error occured in loginform
        $errorLogin = "Login credentials incorrect.";
    }
}
