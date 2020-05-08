<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Questions extends Model
{
    /**
     * Get the route key for the model.
     * Using the column "slug" value instead of the ID to retrieve values. ex: http://localhost:8080/api/questions/reprehenderit-consequuntur-consequatur-nihil
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //$fillable Laravel built-in variable where we can define which POST variables must be defined when creating a question to prevent the "Mask assignment" issue
    //This variable is relevant if we decide to use "Questions::create($request->all());" one liner for handling POSTs when creating questions in "/app/Http/Controllers/QuestionsController.php" in the "store" method
    //protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];

    //We can use "guarded" if we choose not to use above $fillable. We can leave the array empty. This will also prevent the "Mask assignment" issue
    protected $guarded = [];

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
