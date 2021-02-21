<?php

namespace App\Http\Resources;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
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
      return [
        'id' => $this->id,
        'title' => $this->title,
        //'articles' => ArticleResource::collection($this->whenLoaded('articles')->get()->toArray()),
        //'articles' => ArticleResource::collection($this->articles),
        'articles' => ArticleResource::collection($this->whenLoaded('articles')),
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at,
      ];
    }
}
