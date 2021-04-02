<?php

namespace Utils;

/**
 * Autoloader which loads Classes, Interfaces and Traits
 * Expects the usage of Namespaces
 *
 * Needs the following defined constants to work:
 * APP_PATH -> Path to the directory containing Classes and Interfaces
 *
 * SPL takes care of resolving the filename
 * @see https://www.php.net/manual/en/function.spl-autoload-register.php
 */
class AutoLoader
{
    /**
     * autoload a given classname
     *
     * @param string $className The class to be loaded
     * @return void
     */
    public static function load($className)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $filename = APP_PATH . $path . '.php';

        if (!file_exists($filename)) {
            error_log('File: ' . $filename . ' not found');
            return;
        }

        require_once($filename);
    }
}
