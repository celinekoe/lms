<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['user_id', 'subsection_id', 'assignment_id', 'name', 'type', 'url'];
}
