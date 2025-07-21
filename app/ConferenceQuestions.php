<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConferenceQuestions extends Model
{
    protected $table = 'conference_questions';

    public function session() {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function registration() {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
