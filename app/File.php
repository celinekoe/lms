<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserFile;

class File extends Model
{
    protected $fillable = ['user_id', 'subsection_id', 'assignment_id', 'name', 'extension', 'type', 'size', 'length', 'url'];
}
