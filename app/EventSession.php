<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    protected $fillable = ['display_order', 'title'];

    public function intervals() {
        return $this->hasMany(EventSessionInterval::class);
    }
}
