<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title', 'place', 'description'
    ];

    // relation to model user
    public function users()
    {
        return $this->belongsToMany('App\User')->using('App\Application')
            ->withPivot('id', 'description', 'status', 'note')
            ->withTimestamps();
    }
}
