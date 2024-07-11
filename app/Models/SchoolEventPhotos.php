<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolEventPhotos extends Model
{
	protected $table = 'event_photos';

	protected $fillable = [
		'event_id', 'photo'
	];

	public $timestamps = false;
}