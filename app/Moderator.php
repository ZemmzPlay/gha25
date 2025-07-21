<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    protected $table = 'moderators';

    protected $fillable = [
        'name'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
?>