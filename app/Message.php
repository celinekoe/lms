<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['receiver_id', 'sender_id', 'message_thread_id', 'body'];
}
