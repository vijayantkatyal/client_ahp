<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldAttendance extends Model
{
	protected $table = 'field_attendance';

	protected $fillable = [
		'event_id', 'student_id', 'will_be_there', 'time_recorded'
	];

	public $timestamps = false;
}