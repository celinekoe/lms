<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserFile;

class File extends Model
{
    protected $fillable = ['user_id', 'subsection_id', 'assignment_id', 'name', 'type', 'url'];

	/**
     * Scope a query to only include files which have not been downloaded by the user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDownloaded($query)
    {
    	return $query->where('downloaded', false);
    }
}
