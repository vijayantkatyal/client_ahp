<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarDirector extends Model
{
	protected $table = 'calendar_director';

	protected $fillable = [
		'date', 'school_activity', 'no_of_classes', 'director_on_duty', 'activity'
	];

	public $timestamps = false;
}