<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Questions extends Model
{
    //Using Laravel's Bootable Eloquent Traits :https://andy-carter.com/blog/using-laravel-s-eloquent-traits
    protected static function boot()
    {
        parent::boot(); // returning the existing functionality of this Model

        //Adding the additional functionality (create a slug using the title) whenever this model gets created (during HTTP requests when creating a question & etc)
        static::creating(function($question){
            $question->slug = str_slug($question->title);
        });

        //Adding the additional functionality (create a slug using the title) whenever this model gets updated (during HTTP requests when creating a question & etc)
        static::updating(function($question){
            $question->slug = str_slug($question->title);
        });
    }

    /**
     * Get the route key for the model.
     * Using the column "slug" value instead of the ID to retrieve values. ex: http://localhost:8080/api/questions/reprehenderit-consequuntur-consequatur-nihil
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

    //User relationship -  A Question belongs to (belongsTo) a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Reply relationship - A Question can have many (hasMany) Replies
    public function replies()
    {
        // In here defining the Foreign key explicitly is not a must and it'll be handled automatically by Laravel by default, however we can defined it if we want the column name to be specific.
        // "question_id" is the foreign key that will be in the Replies table which  will reference the "id" column of the Questions table
        return $this->hasMany(Replies::class, 'question_id', 'id');
    }

    //Category relationship - A Question belongs to a Category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * getPathAttribute is a built-in function available to Laravel to return the path
     * The "asset" will return the application URL. ex: http://localhost:8080/. To that, we are appending the "api/question/$this->slug"
     * This will return data in the "path" attribute.
     */
    public function getPathAttribute()
    {
        //return asset("api/questions/$this->slug"); //asset will return the  domain with the slug: Ex: http://localhost:8080/api/questions/this-is-the-test-title
        return "/question/$this->slug";
    }
}
