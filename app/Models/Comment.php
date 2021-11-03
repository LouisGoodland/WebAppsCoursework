<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //A comment belongs to a user
    public function comment(){
        return $this->belongsTo(Account::class);
    }

    //a comment potentially has multiple notifications
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
