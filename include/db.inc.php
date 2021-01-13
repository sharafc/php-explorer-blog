<?php

/**
 * Creates a database connection with PDO
 * Configuration and values are stored in an external config file
 *
 * @param string $dbname (optional) Name of the database to connect to, defaults to DB_NAME
 * @return object $pdo The PHP database object
 */
function dbConnect($dbname = DB_NAME)
{
    if (DEBUG_DB) {
        echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Trying to connect to database <b>$dbname</b>... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }

    try {
        $pdo = new PDO(DB_SYSTEM . ":host=" . DB_HOST . "; dbname=$dbname; charset=utf8mb4", DB_USER, DB_PWD);
    } catch (PDOException $error) {
        if (DEBUG_DB) {
            echo "<p class='error'><b>Line " . __LINE__ . ":</b> <i>ERROR: " . $error->GetMessage() . " </i> <i>(" . basename(__FILE__) . ")</i></p>\r\n";
        }
        exit;
    }

    if (DEBUG_DB) {
        echo "<p class='debugDb ok'><b>Line " . __LINE__ . ":</b> Successfully connected to <b>$dbname</b>. <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }

    return $pdo;
}
