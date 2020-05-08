<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //this will expose all the attributes
        //return parent::toArray($request);
        return [
            'title' => $this->title,
            'path' => $this->path, //path will be returned from the Laravel's "getPathAttribute" function which we've overridden in the "Questions" model
            'body' => $this->body,
            'created_at' => $this->created_at,
            'date_readable' => $this->created_at->diffForHumans(), // converting it to a readable date. ex: "3 days ago"
            'user' => $this->user->name // we can grab the user's name since we've referenced the the User model inside the Questions model (in "function user()").
        ];
    }
}
