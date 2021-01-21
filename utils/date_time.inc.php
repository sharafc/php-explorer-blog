<?php

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
function formattedDate($date)
{
    $dateArray = explode(' - ', date('d.m.Y - H:i:s', strtotime($date)));
    $formattedDateString = $dateArray[0] . ' at ' . $dateArray[1] . ' o\'clock';

    return $formattedDateString;
}
