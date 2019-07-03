<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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

    public function developerTask()
    {
        return $this->belongsToMany('App\Task', 'user_tasks', 'developer_id', 'task_id');
    }

    public function managerTask()
    {
        return $this->belongsToMany('App\Task', 'user_tasks', 'manager_id', 'task_id');
    }

    public static function isManager()
    {
        if(Auth::user()->role == 'manager') {
            return true;
        }

        return false;
    }

    public static function isDeveloper()
    {
        if(Auth::user()->role == 'developer') {
            return true;
        }

        return false;
    }
}
