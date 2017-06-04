<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubsectionDownloadFile extends Model
{
    protected $fillable = ['user_id', 'subsection_id', 'name', 'type', 'extension', 'url'];
}
