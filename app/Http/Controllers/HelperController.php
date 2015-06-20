<?php

namespace KnessetRollCall\Http\Controllers;

use Illuminate\Http\Request;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;

class HelperController extends Controller
{

    public static function diffInHoursAndMinutes($diffInMinutes)
    {
        $hours = floor($diffInMinutes/60);
        $minutes = $diffInMinutes - ($hours * 60);

        return $hours.':'.$minutes;
    }
}
