<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    protected $guarded = [];

     //User relationship - every reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Question relationship - every reply belongs to a question
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
