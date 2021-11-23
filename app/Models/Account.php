<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    //each account has multiple posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //each account has multiple comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //each account has multiple friendships
    //note, sender is used. means accounts can "follow" other accounts
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'account_id_sender');
    }

    //each account has multiple notification
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    //an account has many interactions with a post
    public function account_post_interactions()
    {
        return $this->hasMany(AccountPostInteraction::class);
    }
}
