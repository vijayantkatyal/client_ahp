<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
	protected $table = 'courses';

	protected $fillable = [
		'name', 'added_on', 'description'
	];

	public $timestamps = false;
}