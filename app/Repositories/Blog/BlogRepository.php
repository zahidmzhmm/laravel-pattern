<?php

namespace App\Repositories\Blog;

use App\Dto\BlogPostDto;
use App\Http\Resources\Api\BlogPostResource;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
    public function index()
    {
        return BlogPostResource::collection(Blog::paginate(10));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(BlogPostDto $dto)
    {
        $make = Blog::create([
            "title" => $dto->title,
            "content" => $dto->content,
            "source" => $dto->source
        ]);
        return BlogPostResource::make($make);
    }

    /**
     * @param Blog $blog
     * @return mixed
     */
    public function show(Blog $blog)
    {
        return BlogPostResource::make($blog);
    }

    /**
     * @param Blog $blog
     * @param BlogPostDto $dto
     * @return mixed
     */
    public function update(Blog $blog, BlogPostDto $dto)
    {
        $update = tap($blog)->update([
            "title" => $dto->title,
            "content" => $dto->content
        ]);
        return BlogPostResource::make($update);
    }

    /**
     * @param Blog $blog
     * @return mixed
     */
    public function delete(Blog $blog)
    {
        $blog->delete();
        return true;
    }
}
