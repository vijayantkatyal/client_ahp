<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarSchool extends Model
{
	protected $table = 'calendar_school';

	protected $fillable = [
		'date', 'school_activity', 'no_of_classes', 'activity'
	];

	public $timestamps = false;
}