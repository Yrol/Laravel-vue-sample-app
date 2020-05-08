<?php

namespace App;

use App\Model\Likes;
use App\Model\Questions;
use App\Model\Replies;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Questions relationship - A User could have many questions
    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

    //  //Replies relationship - A User could have many replies
    // public function replies()
    // {
    //     return $this->hasMany(Replies::class);
    // }

    //  //Likes relationship - A User could have many likes
    // public function likes()
    // {
    //     return $this->hasMany(Likes::class);
    // }
}
