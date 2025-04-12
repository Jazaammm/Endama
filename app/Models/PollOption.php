<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id', 'title'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
        //"This option belongs to one poll."
    }

    public function responses()
    {
        return $this->hasMany(PollResponse::class, 'option_id');
        //"This option can be selected by many students."
    }
}
