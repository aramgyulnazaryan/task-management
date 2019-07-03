<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'deadline', 'status'
    ];

    public function managers()
    {
        return $this->belongsToMany('App\User', 'user_task');
    }
}
