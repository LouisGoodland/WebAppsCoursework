<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    //a friendship is created by a user
    public function friendship(){
        return $this->belongsTo(Account::class);
    }

    //a friendship potentially has multiple notifications
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
