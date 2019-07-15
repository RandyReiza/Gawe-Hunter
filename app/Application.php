<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Application extends Pivot
{
    protected $table = 'job_user';

    protected $fillable = [
        'user_id', 'job_id', 'description', 'status'
    ];
}
