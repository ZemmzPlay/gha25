<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Registration;
use App\Posts;

class PostLikes extends Model
{
    public function user() {
		return $this->belongsTo(Registration::class, 'user_id');
	}

    public function post() {
		return $this->belongsTo(Posts::class, 'post_id', 'id');
	}
}
