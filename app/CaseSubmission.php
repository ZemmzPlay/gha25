<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseSubmission extends Model
{
    protected $table = 'case_submissions';

    protected $appends = ['countryName'];

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'hospital_name',
        'country',
        'synopsis_case',
        'document',
    ];

    public function getCountryNameAttribute()
    {
        $countries = config('countries');
        return $countries[$this->country] ? $countries[$this->country]['name'] : $this->country;
    }
}
