<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
	protected $table = 'student_assignments';

	protected $fillable = [
		'user_id', 'assignment_id', 'file', 'note', 'marks_obtained', 'accepted'
	];

	public $timestamps = false;
}