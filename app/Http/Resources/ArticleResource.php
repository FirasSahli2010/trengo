<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
          'id' => $this->id,
          'title' => $this->title,
          'desc' => $this->desc,
          //'categories' => new CategoryResource($this->loadMissing('articles')),
          //'categories' => CategoryResource::collection($this->categories),
          'categories' => CategoryResource::collection($this->whenLoaded('categories')),
          'created_at' => (string) $this->created_at,
          'updated_at' => (string) $this->updated_at,
        ];
    }
}
