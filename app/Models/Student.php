<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable // Change this from Model to Authenticatable
{
    use HasFactory, Notifiable; // Added Notifiable for notifications

    protected $fillable = ['name', 'email', 'password', 'year_level', 'section'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];
}

