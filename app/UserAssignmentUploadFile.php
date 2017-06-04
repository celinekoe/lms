<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAssignmentUploadFile extends Model
{
    protected $fillable = ['user_id', 'assignment_id', 'name', 'type', 'extension', 'url'];
}
