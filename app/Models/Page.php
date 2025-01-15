<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

	protected $fillable = [
		'name', 'type', 'show_in_top_menu', 'show_in_footer', 'title', 'summary', 'image', 'content'
	];

	public $timestamps = false;
}