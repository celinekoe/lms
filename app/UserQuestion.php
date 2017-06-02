<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
     protected $fillable = ['user_id', 'question_id', 'option_id'];
}
