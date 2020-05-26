<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Questions;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{
    public function __construct()
    {
        //Middleware that validate tokens. Except "index" and "show" means non-logged in users can only view all or single question. Not allowed to create, delete or update
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Using Eloquent to get all the news in latest order. This is wil expose all the data
        //return Questions::latest()->get();

        //Using the "QuestionResource" API Resource wrapper to expose only the specified data
        return QuestionResource::collection(Questions::latest()->get());
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
        // $question->slug = str_slug($request->title); //using the Laravel's helper method "str_slug" tpo create a title out of title text
        // $question->body = $request->body;
        // $question->category_id = $request->category_id;
        // $question->user_id = $request->user_id;
        // $question->save();


        //Method 2 - one liner, this will save everything that will come in the request
        //when we use this method, we must make sure the "$fillable" variable is specified with mandatory fields in the relevant controller (in this case "/app/Http/Controllers/QuestionsController.php")
        $request['slug'] = str_slug($request->title);//adding the slug value to manually using the title and in-build laravel "str_slug"
        //Questions::create($request->all());
        auth()->user()->questions()->create($request->all());//Using the "auth" based on the relationship defined in "User.php" - return $this->hasMany(Questions::class);
        return response('Created', Response::HTTP_CREATED);//on completion return success (HTTP_CREATED - 201)
    }

    /**
     * Display a specific question by ID.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */

    public function show(Questions $question){

        //Return a single record
        //return $question;

        //Return a single record using the "QuestionResource" wrapper which will expose only the specified data
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $question)
    {
        //Multiple lines search the record by ID (in this case we should replace the "Questions $question" argument with $id and pass the ID in the API request)
        // $question = Questions::where('id', $id)->first();
        // $new_data = $request->all();
        // $question->fill($new_data);
        // $question->save();

        //one liner inside try catch
        try {
            $question->update($request->all());
        } catch (\Illuminate\Database\QueryException $e) {
            return response('An error occurred', Response::HTTP_BAD_GATEWAY);
        }
        return response("Updated", Response::HTTP_ACCEPTED);
    }

    /**
     * Removing a specific question
     * Delete by slug: http://localhost:8080/api/questions/this-is-the-new-title
     * Delete by  ID: http://localhost:8080/api/questions/1
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $question)
    {
        //Method 1
        $question->delete();

        //Method 2
        //Questions::destroy($id); //An ID variable need to be passed as an argument ("public function destroy($id)") instead of "Question $question" and need to make sure default identifier is not "slug"
        //outputting the  204 response using the Response defined in "/vendor/symfony/http-foundation/Response.php" to get the pre-defined responses
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
