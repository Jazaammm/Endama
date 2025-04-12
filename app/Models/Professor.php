<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function polls()
    {
        return $this->hasMany(Poll::class);
        //"This professor can create many polls."
    }
}
