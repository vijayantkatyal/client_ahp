<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormMembership extends Model
{
	protected $table = 'forms_mems';

	protected $fillable = [
		'user_id', 'created_at', 'name', 'spouse_name'
	];

	public $timestamps = false;
}