<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
	protected $table = 'terms_table';

	protected $fillable = [
		'title', 'type', 'terms'
	];

	public $timestamps = false;
}