<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{

    // !!! mengarahlan model CV ke table cv dlm database
    // protected $table = 'cv';

    protected $fillable = [
        'user_id', 'file', 'caption'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
