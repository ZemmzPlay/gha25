<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCategory extends Model
{
    protected $fillable = ['name', 'display_order'];

    public function members(){
        return $this->hasMany('App\FacultyMember');
    }
}
