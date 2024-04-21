<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	protected $table = 'attendance';

	protected $fillable = [
		'user_id', 'class_id', 'date', 'present'
	];

	public $timestamps = false;
}