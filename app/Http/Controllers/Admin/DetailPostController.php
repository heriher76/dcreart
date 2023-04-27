<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\DetailPost;
use App\Models\Category;

use DataTables;
use Validator;
use Str;
use Carbon\Carbon;

class DetailPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;
        $categorys = Category::get();
        return view('pages.admin.posts.form', [
            'categorys' => $categorys,
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'path_thumbnail' => 'image|max:3072',
            'category' => 'required|exists:categorys,id'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }
            
        try {
            
            $slug = Str::slug($request->title.'-'.Str::random(8));
            
            $fpath = null;

            if (!empty($request->file('path_thumbnail'))) {
                $pathBukti = "public/files/post/";
                $fname = Str::slug(Carbon::now()->format('Ymds-').$slug).".".$request->file('path_thumbnail')->getClientOriginalExtension();
                $fpath = $request->file('path_thumbnail')->storeAs($pathBukti, $fname);
            }

            if (!empty($request->publish)) {
                $published_at = Carbon::now();
            }

            $storePost = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'path_thumbnail' => $fpath,
                'slug' => $slug,
                'published' => (boolean)$request->publish,
                'published_at' => ($request->publish == true)?$published_at:null,
                'slug' => $slug,
                'created_by' => 'Admin'
            ]);

            if($storePost){
                for ($i=0; $i < count($request->category); $i++) { 
                    $detailPost = DetailPost::create([
                        'post_id' => $storePost->id,
                        'category_id' => $request->category[$i]
                    ]);
                }
    
                
    
                return response()->json($storePost, 200);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function checkboxPublish(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $published = $request->published;
        if ($published == "true") {
            $changePublished = false;
            $changePublishedAt = null;
        }else{
            $changePublished = true;
            $changePublishedAt = Carbon::now();
        }
        
        $update = $post->update([
            'published' => $changePublished,
            'published_at' => $changePublishedAt
        ]);

        if ($changePublished == "true") {
            $message = "Data '".$post->title."' berhasil dipublish !";
        }else{
            $message = "Data '".$post->title."' berhasil diunpublish !";
        }

        return response()->json([
            'message' => $message,
            'data' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categorys = Category::get();
        return view('pages.admin.posts.form', [
            'data' => $post,
            'categorys' => $categorys
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'path_thumbnail' => 'image|max:3072',
            'category' => 'required|exists:categorys,id'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        try {
            $post = Post::where('slug', $slug);

            $slug = $post->first()->slug;
            $fpath = $post->first()->path_thumbnail;
            $published = $post->first()->published;

            if (!$request->publish) {
                $published_at = null;
            }else{
                $published_at = Carbon::now();
            }

            if($published){
                $published_at = $post->first()->published_at;
            }

            if (!empty($request->file('path_thumbnail'))) {
                $pathBukti = "public/files/post/";
                $fname = Str::slug(Carbon::now()->format('Ymds-').$slug).".".$request->file('path_thumbnail')->getClientOriginalExtension();
                $fpath = $request->file('path_thumbnail')->storeAs($pathBukti, $fname);
            }

            

            $update = $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'path_thumbnail' => $fpath,
                'slug' => $slug,
                'published' => (boolean)$request->publish,
                'published_at' => $published_at,
                'created_by' => 'Admin'
            ]);

            if ($update) {

                $msg = "Postingan berhasil diubah !";

                DetailPost::where('post_id', $post->first()->id)->delete();

                if(count($request->category) > 0){
                    for ($i=0; $i < count($request->category); $i++) {
                        DetailPost::create([
                            'post_id' => $post->first()->id,
                            'category_id' => $request->category[$i]
                        ]);
                    }
                }

            }
            
            return response()->json([
                'message' => $msg,
                'post' => $post->first()->detail_posts
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $detailPost = DetailPost::where('post_id', $post->id);
        for ($i=0; $i < count($detailPost->get()); $i++) { 
            $detailPost->get()[$i]->delete();
        }

        $delete = $post->delete();
        if($delete){
            return response()->json([
                'message' => 'Data berhasil dihapus !'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal dihapus !'
            ], 500);
        }
        
    }

    public function data()
    {
        try {

            
            $posts = Post::get();

            return DataTables::of($posts)->addColumn('category',function($row)
            {
                $cat = null;
                if (!empty($row->detail_posts)) {
                    for ($i=0; $i < count($row->detail_posts); $i++) { 
                        $cat[$i] = $row->detail_posts[$i]->category;
                        
                    }
                }

                return $cat;

            })->addColumn('action', function ($row)
            {
                $link['edit'] = route('admin.post.edit', $row->slug);
                $link['delete'] = route('admin.post.destroy', $row->slug);
                $link['previewAsReader'] = route('admin.post.preview.asReader', $row->slug);

                return $link;
            })->addColumn('created_at', function ($row)
            {
                return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
            })->addIndexColumn()->make(true);
            // return view('layouts.tes', compact('posts'));
            // return view('pages.admin.posts.index');
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function previewAsReader($slug)
    {
        $post = Post::where([
            ['slug', '=', $slug]
        ])->first();
        
        if(empty($post)){
            return view('pages.guest.404');
        }

        $latestPosts = Post::orderBy('created_at', 'DESC')->paginate(4);

        return view('pages.guest.post.detail', [
            'post' => $post,
            'latestPosts' => $latestPosts
        ]);
    }
}
