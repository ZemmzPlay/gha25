<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
  protected $appends = ['image_file', 'country_name'];

  protected $fillable = [
    'first_name',
    'last_name',
    'subtitle',
    'country',
    'image',
    'committee_category_id',
    'display_order'
  ];

  public function category()
  {
    return $this->belongsTo('App\CommitteeCategory', 'committee_category_id');
  }

  public static function imagesFolder()
  {
    return "images/committees/";
  }

  public function getImageFileAttribute()
  {
    if ($this->image && file_exists(self::imagesFolder() . $this->image)) {
      return self::imagesFolder() . $this->image;
    }
    else {
      return self::imagesFolder() . 'default_2.jpg';
    }
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
