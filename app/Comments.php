<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

    protected $table = "comments";

    protected $fillable = ['article_id', 'user_id', 'text', 'date', 'Visible'];

    public $timestamps = false;

}
