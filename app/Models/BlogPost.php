<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{

    // protected $table = 'blogposts';
    protected $fillable = ['title', 'content'];


    public function comments()
    {
        return $this->hasMany(Comment::class);
        // return $this->hasMany('App/Models/Comment');


    }
}
