<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id', 'experience'
    ];

    // relation to model user    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
