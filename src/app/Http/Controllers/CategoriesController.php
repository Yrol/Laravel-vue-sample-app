<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Model\Categories;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends Controller
{
    /**
     * Get all Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Categories::latest()->get());
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Method 1
        // $category = new Categories;
        // $category->name = $request->name;
        // $category->slug = str_slug($request->name); //using the Laravel's helper method "str_slug" tpo create a title out of title text
        // $category->save();

        //Method 2 - single line compared to multi line in method 1
        Categories::create($request->all());
        return response('Created', Response::HTTP_ACCEPTED);
    }

    /**
     * Display a specific Category.
     *
     * @param  \App\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        //Method 1: By defining the fields explicitly that need to be updated
        // $category->update(
        //     [
        //         'name' => $request->name,
        //         'slug' => str_slug($request->name)
        //     ]
        // );

        //Method 2: one liner inside try catch
        try {
            $category->update($request->all());
        } catch (\Illuminate\Database\QueryException $e) {
            return response('An error occurred', Response::HTTP_BAD_GATEWAY);
        }
        return response("Updated", Response::HTTP_ACCEPTED);
    }

    /**
     * Remove a specific Category
     * Delete by slug: http://localhost:8080/api/categories/this-is-the-new-category
     * Delete by  ID: http://localhost:8080/api/categories/1
     * @param  \App\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        $category->delete();

        //Method 2 -  need to pass the $id variable instead of $category
        //Categories::destroy($id);
        //outputting the  204 response using the Response defined in "/vendor/symfony/http-foundation/Response.php" to get the pre-defined responses
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
