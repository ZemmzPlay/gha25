<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $table = 'speakers';

    protected $fillable = [
        'name'
    ];

    public function sessionLectures()
    {
        return $this->belongsToMany(SessionLecture::class, 'session_lecture_speaker');
    }
}
?>