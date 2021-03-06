<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    public function knessetmember()
    {
        return $this->belongsTo('App\KnessetMember');
    }

    public function minutesToHours($minutes = '')
    {
        if (empty($this->minutes)) {
            $this->minutes = $minutes;
        }

        $hour = floor($this->minutes / 60);
        $minute = $this->minutes - ($hour * 60);

        return $hour.':'.$minute;
    }
}
