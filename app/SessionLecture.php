<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionLecture extends Model
{
    protected $table = 'session_lectures';

    protected $fillable = [
        'session_id', 
        'lecture_title', 
        'lecture_start_time', 
        'lecture_end_time',
        'lecture_parts'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'session_lecture_speaker');
    }
}
?>