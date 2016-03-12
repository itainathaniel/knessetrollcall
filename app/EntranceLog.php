<?php

namespace KnessetRollCall;

use Illuminate\Database\Eloquent\Model;
use KnessetRollCall\KnessetMember;

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
