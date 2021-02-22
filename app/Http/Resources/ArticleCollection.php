<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return $this->collection->map(function ($item) {
          return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'views' => $this->whenLoaded('views'),
            'rating' => $this->whenLoaded('ratings'),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
          ];
        });
    }
}
