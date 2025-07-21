<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaActivity extends Model
{
    protected $fillable = ['event_day_id', 'parent_id', 'title', 'start_time', 'end_time'];

    protected function day() {
        return $this->belongsTo(EventDay::class, 'event_day_id', 'id');
    }

    public function activities() {
        return $this->hasMany(AgendaActivity::class);
    }

    public function registrations() {
        return $this->belongsToMany(Registration::class, 'activity_registration', 'activity_id', 'registration_id')->withPivot(['check_in'])->withTimestamps();
    }

    public function getStartTimeAttribute($value) {
        return substr($value, 0, 5);
    }

    public function getEndTimeAttribute($value) {
        return substr($value, 0, 5);
    }
}
