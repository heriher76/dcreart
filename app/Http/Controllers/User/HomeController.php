<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->orderBy('created_at', 'DESC')->paginate(4);
        return view('pages.user.homepage', [
            'posts' => $posts
        ]);
    }
}
