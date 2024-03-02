<?php

namespace App\Http\Controllers;

use App\Enums\BlogPostSource;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "title" => "required|string",
            "content" => "required|string",
        ]);
        $blogPost = new Blog();
        $blogPost->title = $request->get("title");
        $blogPost->content = $request->get("content");
        $blogPost->source = BlogPostSource::APP;
        $blogPost->save();
        return redirect()->route("blog.index")->with("success", "Blog Post Created Successfully");
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
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            "title" => "required|string",
            "content" => "required|string",
        ]);
        $blog = Blog::find($id);
        $blog->title = $request->get("title");
        $blog->content = $request->get("content");
        $blog->source = BlogPostSource::APP;
        $blog->save();
        return redirect()->route("blog.index")->with("success", "Blog Post Updated Successfully");
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
