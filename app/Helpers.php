<?php

function minutesToHours($minutes)
{
    $hour = floor($minutes/60);
    $minute = $minutes - ($hour * 60);

    return $hour . ':' . addLeadingZero($minute);
}

function addLeadingZero($num)
{
    if ($num < 10) {
        $num = '0' . $num;
    }

    return $num;
}