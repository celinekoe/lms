<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuiz extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'attempt_no', 'time_limit_remaining'];
}
