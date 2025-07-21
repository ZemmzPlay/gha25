<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSessionInterval extends Model
{
    protected $fillable = ['display_order', 'title', 'starts_at', 'ends_at', 'speaker', 'event_session_id'];

    public function session() {
        return $this->belongsTo(EventSession::class, 'event_session_id');
    }

    public function registrations() {
        return $this->belongsToMany('App\Registration');
    }
}
