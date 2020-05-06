<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Questions extends Model
{
    //User relationship -  A Question belongs to (belongsTo) a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Reply relationship - A Question can have many (hasMany) Replies
    public function replies()
    {
        return $this->hasMany(Replies::class);
    }

    //Category relationship - A Question belongs to a Category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
