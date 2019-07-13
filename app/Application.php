<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'job_user';

    protected $fillable = [
        'user_id', 'job_id', 'description', 'status'
    ];
}
