<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'year_level', 'section'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];
}
