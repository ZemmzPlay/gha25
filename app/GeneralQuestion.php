<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralQuestion extends Model
{
    public function registrations() {
        return $this->belongsToMany('App\Registration');
    }
}
