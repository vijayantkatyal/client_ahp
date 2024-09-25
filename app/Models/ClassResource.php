<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassResource extends Model
{
	protected $table = 'class_resources';

	protected $fillable = [
		'class_id', 'type', 'file_path', 'name', 'description', 'date', 'tag'
	];

	public $timestamps = false;
}