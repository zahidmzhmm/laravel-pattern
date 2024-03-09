<?php

namespace App\Http\Controllers;

use App\Dto\BlogPostDto;
use App\Http\Requests\App\BlogPostRequest;
use App\Http\Resources\App\BlogPostResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(protected BlogRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->index();
        return view("user.blog.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.blog.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request)
    {
        $this->repository->store(dto: BlogPostDto::fromAppRequest($request));
        return redirect()->route("blog.index")->with("success", "Blog Post Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog = BlogPostResource::make($blog);
        return view("user.blog.show", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog = BlogPostResource::make($blog);
        return view("user.blog.edit", compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, Blog $blog)
    {
        $this->repository->update(blog: $blog, dto: BlogPostDto::fromAppRequest($request));
        return redirect()->back()->with("success", "Blog Post Updated Success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->repository->delete($blog);
        return redirect()->route("blog.index")->with("success", "Success");
    }
}
