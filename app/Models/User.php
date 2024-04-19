<?php

namespace App\Models;

use IsotopeKit\AuthAPI\Models\User as iso_user;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends iso_user
{
    
}
