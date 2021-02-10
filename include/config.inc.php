<?php
/* Delimiters */
define('DELIMITER_PATH', '/');
define('DELIMITER_FILE', '.');

/* Debugging switches */
define('DEBUG', true);          // Debugging for main document
define('DEBUG_F', true);        // Debugging for functions
define('DEBUG_ARRAY', true);    // Debugging for arrays
define('DEBUG_DB', true);       // Debugging for database
define('DEBUG_C', true);        // Debugging for classes
define('DEBUG_CC', true);       // Debugging for class constructors

/* Database options */
define('DB_SYSTEM', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog_oop');
define('DB_USER', 'root');
define('DB_PWD', '');

/* Form validation presets */
define('INPUT_MIN_LENGTH', 2);
define('INPUT_MAX_LENGTH', 256);

/* Image upload */
define('IMAGE_MAX_HEIGHT', 700);
define('IMAGE_MAX_WIDTH', 700);
define('IMAGE_MAX_SIZE', 128 * 1024);
define('IMAGE_ALLOWED_MIMETYPES', array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'));

/* Standard path for image upload */
define('IMAGE_UPLOADPATH', 'uploaded_images');

/* Errors */
define('LOGGER_FILE_PATH', 'logs' . DIRECTORY_SEPARATOR);
define('LOGGER_INFO', 'INFO');
define('LOGGER_WARNING', 'WARN');
define('LOGGER_ERROR', 'ERROR');

define('LOGGER_TYPE_OFF', 0);
define('LOGGER_TYPE_FILE', 1);
define('LOGGER_TYPE_SCREEN', 2);
define('LOGGER_TYPE_CONSOLE', 4);
define('LOGGER_TYPE_DEFAULT', LOGGER_TYPE_FILE | LOGGER_TYPE_CONSOLE);