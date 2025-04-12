<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollResponse extends Model
{
    protected $fillable = ['poll_id', 'student_id', 'option_id'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
        //"This answer belongs to one poll."

    }

    public function student()
    {
        return $this->belongsTo(Student::class);
        //"This answer was made by one student."
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'option_id');
        //"This answer chose one option."
    }
}
