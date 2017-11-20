<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function parentComments()
    {
        return $this->comments()->where('parent_id', 0)->orderBy('updated_at' , 'DESC');
    }
}