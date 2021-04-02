<?php

namespace Utils;

use PDO;
use PDOException;

/**
 * Database Connector which connects the application to a database
 * Expects the usage of Namespaces
 *
 * Needs the following defined constants to work:
 * DB_NAME -> Default name of the database
 */
class DatabaseConnector
{
    /**
     * Creates a database connection with PDO
     * Configuration and values are stored in an external config file
     *
     * @param string $dbname (optional) Name of the database to connect to, defaults to DB_NAME
     * @return PDO $pdo The PHP database object
     */
    public static function dbConnect($dbname = DB_NAME)
    {
        try {
            $pdo = new PDO(DB_SYSTEM . ":host=" . DB_HOST . "; dbname=$dbname; charset=utf8mb4", DB_USER, DB_PWD);
        } catch (PDOException $error) {
            logger('Error handling the database connection:', $error->GetMessage());
            return null;
        }

        return $pdo;
    }

}

