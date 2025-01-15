<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

	protected $fillable = [
		'name', 'email', 'phone', 'message', 'created_at'
	];

	public $timestamps = false;
}