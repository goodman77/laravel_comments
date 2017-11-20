<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

 /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function replies()
    {
        return $this->hasMany(__CLASS__, 'parent_id')->orderBy('updated_at' , 'DESC');
    }

    public function allRepliesWithOwner()
    {
        return $this->replies()->with(__FUNCTION__, 'owner');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	
}