<?php

namespace App\Http\Controllers;

use App\Dto\BlogPostDto;
use App\Enums\BlogPostSource;
use App\Http\Requests\App\BlogPostRequest;
use App\Http\Resources\App\BlogPostResource;
use App\Models\Blog;
use App\Services\Blog\BlogPostService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function __construct(
        protected BlogPostService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $blogs = Blog::paginate(10);
        return view("user.blog.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return BlogPostResource
     */
    public function store(BlogPostRequest $request): BlogPostResource
    {
        $post = $this->service->store(dto: BlogPostDto::fromAppRequest($request));
        return BlogPostResource::make($post);
//        return redirect()->route("blog.index")->with("success", "Blog Post Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $blog = Blog::find($id);
        return view("user.blog.show", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $blog = Blog::find($id);
        return view("user.blog.edit", compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, Blog $blog): BlogPostResource
    {
        $blog = $this->service->update(
            blog: $blog,
            dto: BlogPostDto::fromAppRequest($request)
        );
        return BlogPostResource::make($blog);
//        return redirect()->route("blog.index")->with("success", "Blog Post Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route("blog.index")->with("success", "Blog Post Deleted Successfully");
    }
}
