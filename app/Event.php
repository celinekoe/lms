<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'assignment_id', 'quiz_id', 'name', 'full_day', 'date_start', 'date_end'];
}
