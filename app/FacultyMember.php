<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    protected $fillable = ['first_name', 'last_name', 'bio', 'faculty_category_id', 'display_order'];

    public function category() {
        return $this->belongsTo('App\FacultyCategory', 'faculty_category_id');
    }
    public function permission() {
        
        return $this->belongsToMany('\App\Permission');
    }
    public static function imagesFolder() {
        return "images/faculty/";
    }
}
