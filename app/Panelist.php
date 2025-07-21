<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Panelist extends Model
{
    protected $table = 'panelist';

    protected $fillable = [
        'name'
    ];

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'session_panelist');
    }
}
?>