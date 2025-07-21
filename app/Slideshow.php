<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = 'slideshows';

    protected $fillable = [
        'title',
        'details',
        'location',
        'start_date',
        'start_time',
        'active',
        'buttonTheme'
    ];

    public static function imagesFolder() {
        return "images/slideshow/";
    }
}
?>