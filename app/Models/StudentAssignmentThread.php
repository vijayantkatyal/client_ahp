<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssignmentThread extends Model
{
	protected $table = 'student_assignment_thread';

	protected $fillable = [
		'student_assignment_id', 'user_id', 'message', 'time'
	];

	public $timestamps = false;
}