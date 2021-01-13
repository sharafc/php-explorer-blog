<?php
/* Delimiters */
define("DELIMITER_PATH", "/");
define("DELIMITER_FILE", ".");

/* Debugging switches */
define("DEBUG", true);          // Debugging for main document
define("DEBUG_F", true);        // Debugging for functions
define("DEBUG_ARRAY", true);    // Debugging for arrays
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