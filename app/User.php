<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tgl_lahir',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ROLE -----
    // relation to model roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // check apakah sring or array roles
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }
        return $this->hasRoles($roles) || abort(401, 'This action is unauthorized.');
    }

    // fungsi utk array roles {role nya banyak}
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    // fungsi utk string roles {role nya satu}
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
    // -----


    // relation to model CV
    public function cv()
    {
        return $this->hasOne('App\CV', 'user_id');
    }

    // relation to model Skill
    public function skill()
    {
        return $this->hasMany('App\Skill', 'user_id');
    }

    // relation to model Experience
    public function experience()
    {
        return $this->hasMany('App\Experience', 'user_id');
    }

    // relation to model job
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
