<?php

namespace App\Dto;

use App\Enums\BlogPostSource;
use App\Http\Requests\App\BlogPostRequest as AppBlogPostRequest;
use App\Http\Requests\Api\BlogPostRequest as ApiBlogPostRequest;

readonly class BlogPostDto
{
    public function __construct(
        public string         $title,
        public string         $content,
        public BlogPostSource $source
    )
    {

    }

    public static function fromAppRequest(AppBlogPostRequest $request): BlogPostDto
    {
        return new self(
            title: data_get($request, "title", "Untitled"),
            content: data_get($request, "content"),
            source: BlogPostSource::APP
        );
    }

    public static function fromApiRequest(ApiBlogPostRequest $request): BlogPostDto
    {
        return new self(
            title: data_get($request, "title", "Untitled"),
            content: data_get($request, "content"),
            source: BlogPostSource::API
        );
    }
}
