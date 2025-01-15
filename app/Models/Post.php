<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

	protected $fillable = [
		'name', 'title', 'summary', 'image', 'content', 'published', 'created_at'
	];

	public $timestamps = false;
}