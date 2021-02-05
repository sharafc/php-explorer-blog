<?php

/**
 * Simple logger function which enables you to log in different ways to your liking.
 *
 * Example:
 * logger($message, $data, LOGGER_WARNING);
 *
 * @param string $message the message you want to display
 * @param mixed (optional) $data any variable you want to print out
 * @param string (optional) $type the logging severity. Choose from LOGGER_INFO | LOGGER_WARNING |LOGGER_ERROR
 * @param string (optional) $logtype selection which logging you want to trigger.
 *                          Choose any combination of LOGGER_TYPE_FILE | LOGGER_TYPE_SCREEN | LOGGER_TYPE_CONSOLE
 * @return void
 */
function logger($message, $data = NULL, $type = LOGGER_ERROR, $logtype = LOGGER_TYPE_DEFAULT)
{
    $typeToLower = strtolower($type);
    $currentDate = date('Y-m-d H:i:s');
    $backtrace = debug_backtrace()[0];
    $calledFromFile = pathinfo($backtrace["file"])["basename"];
    $calledFromLine = $backtrace["line"];
    $calledFunction = $backtrace["function"];

    // get logtype and write into specific logfiles
    if ($logtype & LOGGER_TYPE_FILE) {
        $logMessage = $currentDate . " | " . $type . " | " . $message . PHP_EOL;

        if (!is_dir(LOGGER_FILE_PATH)) {
            mkdir(LOGGER_FILE_PATH);
        }
        $logfile = fopen(LOGGER_FILE_PATH . date("Y-m-d") . "_" . $typeToLower . "_log.txt", "a");

        fwrite($logfile, $logMessage);
        if (isset($data)) {
            fwrite($logfile, print_r($data, true) . PHP_EOL);
        }
        fclose($logfile);
    }

    // echo message and print out data. TODO: Make data type dependent
    if ($logtype & LOGGER_TYPE_SCREEN) {
        echo "<div class=\"" . $typeToLower . "\">";
        echo '<time datetime="' . $currentDate . '">' . $currentDate . ':&nbsp;</time>';
        echo $message . "<br>";
        echo "<pre>Called from " . $calledFromFile . " on line " . $calledFromLine . "<br>\r\n";
        if (isset($data)) {
            echo print_r($data, true) . "<br>";
        }
        echo "</pre>";
        echo '</div>';
    }

    // jsonify data and write to console.log/info/error
    if ($logtype & LOGGER_TYPE_CONSOLE) {
        echo "<script>";
        echo "console." . $typeToLower . "(\"Called from " . $calledFromFile . " on line " . $calledFromLine . "\");";
        echo "console." . $typeToLower . "(\"" . $message . " \");";
        if (isset($data)) {
            echo "console." . $typeToLower . "(" . json_encode($data, JSON_HEX_TAG) . ");";
        }
        echo "</script>";
    }
}
