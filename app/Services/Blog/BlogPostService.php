<?php

namespace App\Services\Blog;

use App\Dto\BlogPostDto;
use App\Models\Blog;

class BlogPostService
{
    public function store(BlogPostDto $dto)
    {
        return Blog::create([
            'title' => $dto->title,
            'content' => $dto->content,
            'source' => $dto->source,
        ]);
    }

    public function update(Blog $blog, BlogPostDto $dto)
    {
        return tap($blog)->update([
            'title' => $dto->title,
            'content' => $dto->content,
        ]);
    }

    public function forceDelete(Blog $blog): bool
    {
        return $blog->delete();
    }
}
