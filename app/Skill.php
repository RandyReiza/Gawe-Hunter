<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id', 'skill', 'level'
    ];

    // relation to model user    
    public function user()
    {
        return $this->belongTo('App\User', 'user_id');
    }
}
