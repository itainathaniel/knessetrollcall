<?php

namespace KnessetRollCall;

use Illuminate\Database\Eloquent\Model;

class EntranceLog extends Model
{

    public function processed()
    {
        $this->processed = true;

        $this->save();
    }

}
