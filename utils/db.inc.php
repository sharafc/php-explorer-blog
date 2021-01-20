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
    try {
        $pdo = new PDO(DB_SYSTEM . ":host=" . DB_HOST . "; dbname=$dbname; charset=utf8mb4", DB_USER, DB_PWD);
    } catch (PDOException $error) {
        logger("Error handling the database connection:", $error->GetMessage());
        exit;
    }

    return $pdo;
}

// Connect to DB
$pdo = dbConnect();
