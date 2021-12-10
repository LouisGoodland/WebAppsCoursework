<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    //morphs to the type that caused the notification type
    public function notifiable()
    {
        return $this->morphTo();
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }
    
}
