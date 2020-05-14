<?php

namespace App\Http\Controllers;

use App\Model\Questions;
use App\Model\Replies;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepliesController extends Controller
{
    public function __construct()
    {
        //Middleware that validate tokens. Except "index" and "show" means non-logged in users can only view all or single reply. Not allowed to create, delete or update.
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }
    /**
     * Displaying all Replies belongs to a specific Question
     * API Route: "api/question/{question}/reply"
     * @return \Illuminate\Http\Response
     */
    public function index(Questions $question)
    {
        //this relationship is defined in the Questions model in the "replies" method where "hasMany(Replies::class);"
        return $question->replies;
    }

    /**
     * Creating a ne reply to a given question
     * API Route: "api/question/{question}/reply"
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Questions $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        return response(['reply' => $reply], Response::HTTP_CREATED); // returning the newly created reply with the response
    }

    /**
     * Displaying a specific reply belonging to a specific Question
     * API Route: "api/question/{question}/reply/{reply}" - in here the reply value ({reply}) must be the reply ID
     * @param  \App\Model\Replies  $replies
     * @return \Illuminate\Http\Response
     * Although we don't use teh $question variable below in the function, we must pass it as an argument since the API route expects the variable {questions}. If we don't have this, an error will be thrown.
     */
    public function show(Questions $question, Replies $reply)
    {
        return $reply;
    }

    /**
     * Update a specific reply
     * API Route: "api/question/{question}/reply/{reply}"
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Replies  $replies
     * @return \Illuminate\Http\Response
     * Although we don't use teh $question variable below in the function, we must pass it as an argument since the API route expects the variable {questions}. If we don't have this, an error will be thrown.
     */
    public function update(Questions $question, Request $request, Replies $reply)
    {
        //Method 1
        $reply->update($request->all());

        //Method 2
        //$question->replies()->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Replies  $replies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $question, Replies $reply)
    {
        $reply->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
