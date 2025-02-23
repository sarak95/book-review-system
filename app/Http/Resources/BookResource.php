<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publication_year' => $this->publication_year,
            'author' => new AuthorResource($this->author), 
            'tags' => TagResource::collection($this->tags), 
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
