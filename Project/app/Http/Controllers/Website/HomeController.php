<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->with('categories');
        $categories=Category::all();
        if (request('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');

        }
        $posts = $posts->latest()->paginate(2);

        return view('home', compact('posts','categories'));
    }
}
