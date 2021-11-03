<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //a post is owned by a user
    public function post(){
        return $this->belongsTo(Account::class);
    }

    //a post has multiple comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //a post potentially has multiple notifications
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
