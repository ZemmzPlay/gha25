<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardCountries extends Model
{
	protected $table = 'board_members_countries';
    protected $fillable = ['name', 'display_order'];

    public function members(){
        return $this->hasMany('App\BoardMember', 'country_id');
    }
}
