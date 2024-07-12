<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassAssignment extends Model
{
	protected $table = 'class_assignments';

	protected $fillable = [
		'class_id', 'type', 'file_type', 'name', 'file', 'note', 'max_marks', 'created_by_id'
	];

	public $timestamps = false;
}