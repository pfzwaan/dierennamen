<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->latest('id')
            ->paginate(7)
            ->withQueryString();

        return view('blogs.index', [
            'blogs' => $blogs,
        ]);
    }

    public function show(string $slug): View
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('blogs.show', [
            'blog' => $blog,
        ]);
    }
}
