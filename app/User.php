<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "users";

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;

    public function isAdmin()
    {
        return $this->admin;
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
