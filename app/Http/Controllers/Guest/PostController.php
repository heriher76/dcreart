<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\DetailPost;
use App\Models\SettingsTampilanHeaderHomepage;

use Storage;

class PostController extends Controller
{
    public function index()
    {
        $firstSlider = SettingsTampilanHeaderHomepage::first();
        $posts = Post::where('published', true)->orderBy('published_at', 'DESC')->paginate(6);
        return view('pages.guest.post.index', [
            'posts' => $posts,
            'firstSlider' => $firstSlider
        ]);
    }

    public function show($slug)
    {

        $post = Post::where([
            ['slug', '=', $slug], ['published', '=', true]
        ])->first();
        
        if(empty($post)){
            return view('pages.guest.404');
        }

        $latestPosts = Post::where('published', true)->orderBy('published_at', 'DESC')->paginate(4);

        return view('pages.guest.post.detail', [
            'post' => $post,
            'latestPosts' => $latestPosts
        ]);
    }

    public function showByCategory($category)
    {
        $detailPost = Category::where('name', $category)->first()->detail_posts;

        // $latestPosts = Category::where('name', $category)->first()->detail_posts->simplePaginate(4);

        return view('pages.guest.post.byCategory', [
            'detailPost' => $detailPost,
            // 'latestPosts' => $latestPosts
        ]);
    }
}
