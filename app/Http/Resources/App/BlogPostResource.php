<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "source" => $this->source,
            /*"relatedPosts" => BlogPostResource::collection(
                $this->whenLoaded("relatedPosts")
            ),*/
        ];
    }
}
