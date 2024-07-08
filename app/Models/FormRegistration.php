<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormRegistration extends Model
{
	protected $table = 'forms_regs';

	protected $fillable = [
		'user_id', 'created_at', 'receipt_fee', 'receipt_membership', 'supplies_provided', 'first_name', 'last_name'
	];

	public $timestamps = false;
}