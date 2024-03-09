<?php

namespace App\Repositories;

use App\Models\Blog;

interface BaseRepositoryInterface
{
    public function all();

    public function show(Blog $blog);

    public function store(array $attributes);

    public function update(Blog $blog, array $attributes);
}
