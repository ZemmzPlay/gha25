<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $table = 'workshops';

    protected $casts = [
        'places_left' => 'integer'
    ];

    protected $fillable = [
        'title'
    ];

    public function RegistrationWorkshops()
    {
        return $this->hasMany(RegistrationWorkshop::class);
    }

    public function Registrations()
    {
        return $this->belongsToMany(Registration::class, 'registration_workshops', 'workshop_id', 'registration_id');
    }

    public function getPlacesLeftAttribute()
    {
        $placesTaken = $this->RegistrationWorkshops()->count();
        return $this->places - $placesTaken;
    }

    // public function Registrations(){
    //     return $this->hasMany('App\Registration');
    // }

    // public function RegistrationsSuccess()
    // {
    //     $registrations = [];
    //     foreach($this->Registrations as $registration)
    //     {
    //         if($registration->Payment && $registration->Payment->paid_status == 1)
    //         {
    //             array_push($registrations, $registration);
    //         }
    //     }

    //     return $registrations;
    // }
}
?>