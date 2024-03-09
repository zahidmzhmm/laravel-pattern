<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\BlogPostDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogPostRequest;
use App\Http\Resources\Api\BlogPostResource;
use App\Models\Blog;
use App\Services\Blog\BlogPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogPostController extends Controller
{
    protected BlogPostService $service;

    public function __construct(BlogPostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return BlogPostResource::collection(Blog::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request): BlogPostResource
    {
        $blogPost = $this->service->store(
            dto: BlogPostDto::fromApiRequest($request)
        );
        return BlogPostResource::make($blogPost);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): BlogPostResource
    {
        return BlogPostResource::make($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, Blog $blog): BlogPostResource
    {
        $post = $this->service->update(
            blog: $blog,
            dto: BlogPostDto::fromApiRequest($request)
        );
        return BlogPostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $this->service->forceDelete($blog);
        return response()->json(["status" => "success", "message" => "Blog Post Deleted Successfully"], 200);
    }
}
