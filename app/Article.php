<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

    protected $fillable = ['image', 'title', 'content', 'category_id', 'author', 'status', 'date', 'views'];
}