<?php

namespace App\Repositories\Blog;

use App\Dto\BlogPostDto;
use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function index();

    public function store(BlogPostDto $dto);

    public function show(Blog $blog);

    public function update(Blog $blog, BlogPostDto $dto);

    public function delete(Blog $blog);
}
