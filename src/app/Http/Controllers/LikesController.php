<?php

namespace App\Http\Controllers;

use App\Model\Likes;
use App\Model\Replies;
use Symfony\Component\HttpFoundation\Response;

class LikesController extends Controller
{

    public function __construct()
    {
        //Middleware that validate tokens. Only the logged in users are allowed to like and unlike
        $this->middleware('jwt');
    }

    /**
     * Adding a like to a reply
     * API Route: "api/like/{reply_id}"
     * Ex: http://localhost:8080/api/like/52 - Create a Like for Reply 52.
     * @return \Illuminate\Http\Response
     */
    public function like(Replies $reply)
    {
        //in here we don't have to provide the "reply_id" since it'll be automatically injected as its already defined in "Reply" model "like" function: "$this->hasMany(Likes::class);"
        $reply->likes()->create([
            //'user_id' => auth()->id()
            'user_id' => '1' // hard code the user ID for now
        ]);
    }

    /**
     * Adding a like to a reply
     * API Route: "api/like/{reply_id}"
     * Ex: http://localhost:8080/api/like/52 - delete the Like belong to Reply ID 52 belong to the given user
     * @return \Illuminate\Http\Response
     */
    public function unlike(Replies $reply)
    {
        //Since a user can only like reply once, we get the First like that is equal to the logged in user and then delete it
        $reply->likes()->where('user_id', '1')->first()->delete();
        return response(null, Response::HTTP_NO_CONTENT);
        //$reply->likes()->where('user_id', auth()->id())->first()->delete();
    }
}
