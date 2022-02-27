<?php

namespace App\Http\Controllers\Pages;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CyrildeWit\EloquentViewable\Support\Period;

class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.post.index');
    }

    public function show(Post $post)
    {
        $expireAt = now()->addHours(12);

        views($post)
            ->cooldown($expireAt)
            ->record();

        return view('pages.post.show',[
            'post' => $post,
            'tags' => Tag::all(),
            'populars' => Post::orderByViews('asc', Period::pastDays(3))->inRandomOrder()->limit(4)->get(),
        ]);
    }
}
