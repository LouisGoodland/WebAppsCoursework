<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //regarding comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //regarding notifications
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
