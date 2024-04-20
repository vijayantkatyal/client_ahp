<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
	protected $table = 'classes';

	protected $fillable = [
		'name', 'start_date', 'end_date', 'course_id', 'assigned_member_id', 'added_on'
	];

	public $timestamps = false;
}