<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'name',
        'is_coalition',
    ];

    public function knessetMembers()
    {
        return $this->hasMany('App\KnessetMember')->active();
    }

    public function allknessetMembers()
    {
        return $this->hasMany('App\KnessetMember');
    }

    public function inside()
    {
        return $this->knessetmembers->where('isInside', 1)->count();
    }

    public function presence_today()
    {
        $members = $this->knessetMembers()->pluck('id');

        return Presence::whereIn('knessetmember_id', $members)->where('day', date('Y-m-d'))->sum('work');
    }

    public function presence_week()
    {
        if (date('w') == 0) {
            return $this->presence_today();
        }

        $members = $this->knessetMembers()->pluck('id');

        return Presence::whereIn('knessetmember_id', $members)->where('day', '>=', date('Y-m-d', strtotime('last sunday', time())))->sum('work');
    }

    public function presence_month()
    {
        $members = $this->knessetMembers()->pluck('id');

        return Presence::whereIn('knessetmember_id', $members)->where('day', '>=', (new Carbon())->firstOfMonth())->sum('work');
    }
}
