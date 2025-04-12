<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'professor_id', 'title', 'description', 'start_date', 'end_date', 'status'
    ];


    public function professor()
    {
        return $this->belongsTo(Professor::class);
        //"This poll was made by one professor."
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
        //"This poll has many options to choose from."
    }

    public function responses()
    {
        return $this->hasMany(PollResponse::class);
        //"This poll has many student answers (responses)."
    }

    public function students()
{
    return $this->hasManyThrough(Student::class, PollResponse::class, 'poll_id', 'student_id', 'id', 'student_id');
}
}
