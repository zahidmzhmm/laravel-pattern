<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BlogPostSource;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $blogPosts = Blog::all();
        return response()->json($blogPosts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            "title" => "required|string",
            "content" => "required|string",
        ]);
        $blogPost = new Blog();
        $blogPost->title = $request->get("title");
        $blogPost->content = $request->get("content");
        $blogPost->source = BlogPostSource::API;
        $blogPost->save();
        return response()->json(["status" => "success", "message" => "Blog Post Created Successfully", "data" => $blogPost], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $blogPost = Blog::find($id);
        if (!$blogPost) {
            return response()->json(["status" => "error", "message" => "Blog Post Not Found"], 404);
        }
        return response()->json(["success" => "success", "data" => $blogPost], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $blogPost = Blog::find($id);
        if (!$blogPost) {
            return response()->json(["status" => "error", "message" => "Blog Post Not Found"], 404);
        }
        $blogPost->title = !empty($request->get("title")) ? $request->get("title") : $blogPost->title;
        $blogPost->content = !empty($request->get("content")) ? $request->get("content") : $blogPost->content;
        $blogPost->source = BlogPostSource::API;
        $blogPost->save();
        return response()->json(["status" => "success", "message" => "Blog Post Updated Successfully", "data" => $blogPost], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $blogPost = Blog::find($id);
        if (!$blogPost) {
            return response()->json(["status" => "error", "message" => "Blog Post Not Found"], 404);
        }
        $blogPost->delete();
        return response()->json(["status" => "success", "message" => "Blog Post Deleted Successfully"], 200);
    }
}
