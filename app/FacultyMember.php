<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    protected $appends = ['country_name'];
    
    protected $fillable = ['first_name', 'last_name', 'bio', 'country', 'faculty_category_id', 'display_order'];

    public function category()
    {
        return $this->belongsTo('App\FacultyCategory', 'faculty_category_id');
    }
    public function permission()
    {

        return $this->belongsToMany('\App\Permission');
    }
    public static function imagesFolder()
    {
        return "images/faculty/";
    }

    /**
     * get country name
     */
    public function getCountryNameAttribute()
    {
        $countries = config('countries');
        return isset($countries[$this->country]) ? $countries[$this->country]['name'] : $this->country;
    }
}
