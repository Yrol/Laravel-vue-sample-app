<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'path' => $this->path,  //path will be returned from the Laravel's "getPathAttribute" function which we've overridden in the "Questions" model
            'created_at' => $this->created_at,
            'date_readable' => $this->created_at->diffForHumans() // converting it to a readable date. ex: "3 days ago"
        ];
    }
}
