<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommitteeCategory extends Model
{
    protected $fillable = ['name', 'display_order'];

    public function committees(){
        return $this->hasMany('App\Committee');
    }
}
