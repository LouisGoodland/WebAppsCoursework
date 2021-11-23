<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPostInteraction extends Model
{
    use HasFactory;

    //can be a cause of a notification
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    //interaction belongs to an account
    public function account(){
        return $this->belongsTo(Account::class);
    }

    //interaction also belongs to a post
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
