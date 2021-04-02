<?php

namespace Utils;

class GenericHelper
{
    /**
     * Escapes and trims a given string
     *
     * @param string $stringToEscape String we want to escape
     * @return string $escapedString The escaped and trimmed string
     */
    public static function cleanString($stringToEscape)
    {
        $escapedString = trim(htmlspecialchars($stringToEscape, ENT_QUOTES | ENT_HTML5, 'utf-8', false));
        return $escapedString;
    }

    /**
     * Converts a database date to the defined string layout:
     * dd-mm-YY at hh:mm:ss o'clock
     *
     * Example:
     * 11.01.2021 at 09:10:55 o'clock
     *
     * @param string $date given date to convert to specific layout
     * @return string $formatedDateString the converted string
     */
    public static function formattedDate($date)
    {
        $dateArray = explode(' - ', date('d.m.Y - H:i:s', strtotime($date)));
        $formattedDateString = $dateArray[0] . ' at ' . $dateArray[1] . ' o\'clock';

        return $formattedDateString;
    }
}