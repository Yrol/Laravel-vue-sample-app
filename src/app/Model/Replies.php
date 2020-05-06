<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
     //User relationship - every reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Question relationship - every reply belongs to a reply
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }

    //Likes relationship - every reply could have many likes
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
}
