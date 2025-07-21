<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostLikes;
use App\User;

class Posts extends Model
{
	public function admin() {
		return $this->belongsTo(User::class, 'admin_id');
	}

	public function likes() {
		return $this->hasMany(PostLikes::class, 'post_id', 'id');
	}

	public function likesNumber() {
		return $this->hasMany(PostLikes::class, 'post_id', 'id')->count();
	}
}
