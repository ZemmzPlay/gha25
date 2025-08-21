<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseSubmission extends Model
{
    protected $table = 'case_submissions';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'hospital_name',
        'country',
        'synopsis_case',
        'document',
    ];
}
