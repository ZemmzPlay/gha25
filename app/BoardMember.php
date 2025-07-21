<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $table = 'board_members';
    protected $fillable = ['name', 'image_file', 'country_id', 'display_order'];

    public function country() {
        return $this->belongsTo('App\BoardCountries', 'country_id');
    }
    
    public static function imagesFolder() {
        return "images/board/";
    }
}
