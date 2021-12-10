<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //A comment belongs to a user
    public function account(){
        return $this->belongsTo(Account::class);
    }

    //a comment belongs to a post
    public function post(){
        return $this->belongsTo(Post::class);
    }

    //a comment potentially has multiple notifications
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
