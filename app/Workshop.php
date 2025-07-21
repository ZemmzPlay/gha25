<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $table = 'workshops';

    protected $fillable = [
        'title'
    ];

    public function Registrations(){
        return $this->hasMany('App\Registration');
    }

    public function RegistrationsSuccess()
    {
        $registrations = [];
        foreach($this->Registrations as $registration)
        {
            if($registration->Payment && $registration->Payment->paid_status == 1)
            {
                array_push($registrations, $registration);
            }
        }

        return $registrations;
    }
}
?>