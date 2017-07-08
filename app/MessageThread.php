<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{
    protected $fillable = ['user_id_1', 'user_id_2', 'preview'];
}
