<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use DNS1D;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Registration extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
    	'title', 
    	'first_name', 
    	'last_name', 
    	'speciality', 
    	'department', 
    	'country', 
    	'city', 
    	'countryCode', 
    	'mobile', 
    	'email', 
    	'receive_updates', 
        'payment_id', 
    	'comment', 
    	'suggestion',
        'workshop_id',
        'onlyWorkshop'
    ];

    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function Registrant()
    {
        return $this->belongsTo(Registrants::class, 'registrant_id');
    }

    public function PaymentSuccess()
    {
        return $this->Payment->where('paid_status', 1);
    }

    public function Workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function getBarcodeAttribute() {
        $id = $this->id;
        return DNS1D::getBarcodePNG(str_pad($id, 7, '0', STR_PAD_LEFT), "EAN8");
    }

    public function activities() {
        return $this->belongsToMany(AgendaActivity::class, 'activity_registration', 'registration_id', 'activity_id')->withPivot(['check_in'])->withTimestamps();
    }

    public function questions()
    {
        return $this->hasMany(ConferenceQuestions::class);
    }
}
