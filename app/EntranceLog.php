<?php

namespace App;

use App\KnessetMember;
use Illuminate\Database\Eloquent\Model;

class EntranceLog extends Model
{
	public function knessetmembers()
	{
		return $this->belongsTo(KnessetMember::class);
	}

    public function processed()
    {
        $this->processed = true;

        $this->save();
    }
}
