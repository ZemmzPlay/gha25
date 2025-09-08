<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationWorkshop extends Model
{
    protected $table = 'registration_workshops';

    protected $fillable = [
        'registration_id', 'workshop_id'
    ];

    public function Registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function Workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
