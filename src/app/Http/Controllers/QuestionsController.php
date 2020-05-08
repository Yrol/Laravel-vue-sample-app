<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Questions;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Using Eloquent to get all the news in latest order
        return new QuestionResource(Questions::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Storing the questions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Method 1 - defining everything one by one
        // $question = new Questions;
        // $question->title = $request->title;
        // $question->slug = $request->slug;
        // $question->body = $request->body;
        // $question->category_id = $request->category_id;
        // $question->user_id = $request->user_id;
        // $question->save();


        //Method 2 - one liner, this will save everything that will come in the request
        //when we use this method, we must make sure the "$fillable" variable is specified with mandatory fields in the relevant controller (in this case "/app/Http/Controllers/QuestionsController.php")
        Questions::create($request->all());
        return response('Created', Response::HTTP_CREATED);//on completion return success (HTTP_CREATED - 201)
    }

    /**
     * Display a specific question by ID.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */

    public function show(Questions $question){
        return new QuestionResource($question);
    }

    // public function show($id)
    // {
    //     $question = Questions::where('id', $id)->firstOrFail();
    //     return response()->json($question);
    // }

    // /**
    //  * Display a specific question by slug.
    //  *
    //  * @param  \App\Model\Questions  $questions
    //  * @return \Illuminate\Http\Response
    //  */
    // public function slug($slug)
    // {
    //     $question = Questions::where('slug', $slug)->firstOrFail();
    //     return response()->json($question);
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Questions::destroy($id);
        //outputting the  204 response using the Response defined in "/vendor/symfony/http-foundation/Response.php" to get the pre-defined responses
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
