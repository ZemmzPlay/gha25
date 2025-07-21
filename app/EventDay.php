<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDay extends Model
{
    protected $fillable = ['date'];
    protected $dates = ['date'];

    public function activities() {
        return $this->hasMany(AgendaActivity::class)->orderBy('start_time');
    }


}
