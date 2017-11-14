<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'comment_id'];
    protected $table = 'likes';

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
