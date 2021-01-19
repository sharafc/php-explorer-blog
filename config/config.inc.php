<?php
/* Delimiters */
define("DELIMITER_FILE", ".");
define("DOMAIN_SUB_STRUCTURE", ""); // Needed if you run on localhost without having setup the vhost

/* Errors */
define("LOGGER_FILE_PATH", "logs" . DIRECTORY_SEPARATOR);
define("LOGGER_INFO", "INFO");
define("LOGGER_WARNING", "WARN");
define("LOGGER_ERROR", "ERROR");

define("LOGGER_TYPE_OFF", 0);
define("LOGGER_TYPE_FILE", 1);
define("LOGGER_TYPE_SCREEN", 2);
define("LOGGER_TYPE_CONSOLE", 4);
define("LOGGER_TYPE_DEFAULT", LOGGER_TYPE_FILE | LOGGER_TYPE_CONSOLE);

/* Debugging switches */
define("DEBUG", false);          // Debugging for main document
define("DEBUG_F", false);        // Debugging for functions
define("DEBUG_ARRAY", false);    // Debugging for arrays
define("DEBUG_DB", true);       // Debugging for database

/* Database options */
define("DB_SYSTEM", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "blog");
define("DB_USER", "root");
define("DB_PWD", "");

/* Form validation presets */
define("INPUT_MIN_LENGTH", 2);
define("INPUT_MAX_LENGTH", 256);

/* Image upload */
define("IMAGE_MAX_HEIGHT", 700);
define("IMAGE_MAX_WIDTH", 700);
define("IMAGE_MAX_SIZE", 128 * 1024);
define("IMAGE_ALLOWED_MIMETYPES", array("image/jpeg", "image/jpg", "image/gif", "image/png"));

/* Standard path for image upload */
define("IMAGE_UPLOADPATH", "uploaded_images");
