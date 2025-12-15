<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $table = 'waiting_list';
    
    protected $fillable = [
        'workshop_id', 'registraion_id'
    ];
}
