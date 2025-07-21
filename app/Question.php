<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function registrations() {
        return $this->belongsToMany('App\Registration', 'question_registration', 'question_id', 'registration_id')->withPivot('answer');
    }

    public function getAverageAttribute() {
        $sum = 0;
        $count = 0;
        foreach ($this->registrations as $registration) {
            $sum += $registration->pivot->answer;
            $count++;
        }
        if($count > 0) {
            return $sum / $count;
        } else {
            return 0;
        }
    }
}
