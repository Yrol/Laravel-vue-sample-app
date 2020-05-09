<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Get the route key for the model.
     * Using the column "slug" value instead of the ID to retrieve values. ex: http://localhost:8080/api/categories/test-category
     * By default Laravel always use the ID and we don't have to define it explicitly using "getRouteKeyName()"
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * $fillable Laravel built-in variable where we can define which POST variables must be defined when creating a question to prevent the "Mask assignment" issue.
     * This variable is relevant if we decide to use "Questions::create($request->all());" one liner for handling POSTs when creating questions in "/app/Http/Controllers/QuestionsController.php" in the "store" method
     */
    //protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];

    //We can use "guarded" if we choose not to use above $fillable. We can leave the array empty. This will also prevent the "Mask assignment" issue
    //If we add a field name to the guard array, it means those fields cannot be updated
    protected $guarded = [];


    /**
     * getPathAttribute is a built-in function available to Laravel to return the path
     * The "asset" will return the application URL. ex: http://localhost:8080/. To that, we are appending the "api/question/$this->slug"
     * This will return data in the "path" attribute.
     */
    public function getPathAttribute()
    {
        return asset("api/categories/$this->slug");
    }
}
