<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';

    protected $fillable = [
        'title', 
        'session_date', 
        'start_time', 
        'end_time', 
        'moderator_id', 
        'total_lecture', 
        'lecture_duration'
    ];

    public function moderator()
    {
        return $this->belongsTo(Moderator::class);
    }

    public function lectures()
    {
        return $this->hasMany(SessionLecture::class);
    }

    public function panelists()
    {
        return $this->belongsToMany(Panelist::class, 'session_panelist');
    }

    public function questions()
    {
        return $this->hasMany(ConferenceQuestions::class);
    }
}
?>