<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolEvents extends Model
{
	protected $table = 'events';

	protected $fillable = [
		'name', 'date', 'description'
	];

	public $timestamps = false;
}