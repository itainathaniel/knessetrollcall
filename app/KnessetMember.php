<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KnessetMember extends Model
{
    protected $table = 'knessetmembers';

    protected $fillable = [
        'knesset_id',
        'party_id',
        'name',
        'image',
        'isInside',
        'active',
    ];

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    public function scopeInside($query)
    {
        return $query->where('isInside', 1);
    }

    public function scopeOutside($query)
    {
        return $query->where('isInside', 0);
    }

    public function scopeOrderByInside($query)
    {
        return $query->orderBy('isInside', 'desc');
    }

    public function scopeOrderByName($query)
    {
        return $query->orderBy('name', 'asc');
    }

    public function party()
    {
        return $this->belongsTo('App\Party');
    }

    public function updatePresence($isInside)
    {
        $this->isInside = $isInside;

        $this->save();
    }

    public function updateImage($image)
    {
        $this->image = $image;

        $this->save();
    }

    public function image_big()
    {
        return str_replace('-s.jpg', '.jpg', $this->image);
    }

    public function image_path()
    {
        return 'http://www.knesset.gov.il'.$this->image;
    }

    public function image_big_path()
    {
        return 'http://www.knesset.gov.il'.str_replace('-s.jpg', '.jpg', $this->image);
    }

    public function presence_yesterday()
    {
        return Presence::whereKnessetmemberId($this->id)->where('day', date('Y-m-d', strtotime('yesterday')))->sum('work');
    }

    public function presence_today()
    {
        return Presence::whereKnessetmemberId($this->id)->where('day', date('Y-m-d'))->sum('work');
    }

    public function presence_week()
    {
        if (date('w') == 0) {
            return $this->presence_today();
        }

        return Presence::whereKnessetmemberId($this->id)->where('day', '>=', date('Y-m-d', strtotime('last sunday', time())))->sum('work');
    }

    public function presence_month()
    {
        return Presence::whereKnessetmemberId($this->id)->where('day', '>=', (new Carbon())->firstOfMonth())->sum('work');
    }
}
