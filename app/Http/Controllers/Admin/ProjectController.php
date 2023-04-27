<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\DetailProject;
use App\Models\Category;
use App\Models\ImgSlider;
use App\Models\ProjectSlider;

use DataTables;
use Validator;
use Str;
use Storage;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.projects.index');
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
        return view('pages.admin.projects.form', [
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
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'path_thumbnail' => 'image',
            'category' => 'required|exists:categorys,id',
            'imgSlider' => 'required'
        ], [
            'imgSlider.required' => 'Harap isi Image Slider !'
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
                $pathBukti = "public/files/project/";
                $fname = Str::slug(Carbon::now()->format('Ymds-').$slug).".".$request->file('path_thumbnail')->getClientOriginalExtension();
                $fpath = $request->file('path_thumbnail')->storeAs($pathBukti, $fname);
            }

            if (!empty($request->publish)) {
                $published_at = Carbon::now();
            }

            $storeProject = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'path_thumbnail' => $fpath,
                'slug' => $slug,
                'published' => (boolean)$request->publish,
                'published_at' => ($request->publish == true)?$published_at:null,
                'slug' => $slug,
                'created_by' => 'Admin'
            ]);

            if($storeProject){
                for ($i=0; $i < count($request->category); $i++) { 
                    $detailProject = DetailProject::create([
                        'project_id' => $storeProject->id,
                        'category_id' => $request->category[$i]
                    ]);
                }
    
                if (!empty($request->file('imgSlider'))) {
                    $pathImgSlider = "public/files/project/img-slider";
                    for ($imgs=0; $imgs < count($request->file('imgSlider')); $imgs++) { 
                        $fnameImgSlider[$imgs] = Str::slug(Carbon::now()->format('Ymds-').$slug.'-'.($imgs+1)).".".$request->file('imgSlider')[$imgs]->getClientOriginalExtension();
                        $fpathImgSlider[$imgs] = $request->file('imgSlider')[$imgs]->storeAs($pathImgSlider, $fnameImgSlider[$imgs]);

                        $imgSlider[$imgs] = ImgSlider::create([
                            'title' => ($request->title_imgSlider[$imgs] != null)?$request->title_imgSlider[$imgs]:null,
                            'path' => $fpathImgSlider[$imgs]
                        ]);

                        $projSlider[$imgs] = ProjectSlider::create([
                            'img_slider_id' => $imgSlider[$imgs]->id,
                            'project_id' => $storeProject->id
                        ]);


                    }
                }
    
                return response()->json($storeProject, 200);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function checkboxPublish(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first();
        $published = $request->published;
        if ($published == "true") {
            $changePublished = false;
            $changePublishedAt = null;
        }else{
            $changePublished = true;
            $changePublishedAt = Carbon::now();
        }
        
        $update = $project->update([
            'published' => $changePublished,
            'published_at' => $changePublishedAt
        ]);

        if ($changePublished == "true") {
            $message = "Data '".$project->title."' berhasil dipublish !";
        }else{
            $message = "Data '".$project->title."' berhasil diunpublish !";
        }

        return response()->json([
            'message' => $message,
            'data' => $project
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
        $project = Project::where('slug', $slug)->first();
        $categorys = Category::get();

        return view('pages.admin.projects.form', [
            'data' => $project,
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
        ], [
            'imgSlider.required' => 'Harap isi Image Slider !'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        try {
            $project = Project::where('slug', $slug);

            $slug = $project->first()->slug;
            $fpath = $project->first()->path_thumbnail;
            $published = $project->first()->published;

            if (!$request->publish) {
                $published_at = null;
            }else{
                $published_at = Carbon::now();
            }

            if($published){
                $published_at = $project->first()->published_at;
            }

            if (!empty($request->file('path_thumbnail'))) {
                $pathBukti = "public/files/project/";
                $fname = Str::slug(Carbon::now()->format('Ymds-').$slug).".".$request->file('path_thumbnail')->getClientOriginalExtension();
                $fpath = $request->file('path_thumbnail')->storeAs($pathBukti, $fname);
            }

            

            $update = $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'path_thumbnail' => $fpath,
                'slug' => $slug,
                'published' => (boolean)$request->publish,
                'published_at' => $published_at,
                'created_by' => 'Admin'
            ]);

            if ($update) {

                $msg = "Project berhasil diubah !";

                DetailProject::where('project_id', $project->first()->id)->delete();

                if(count($request->category) > 0){
                    for ($i=0; $i < count($request->category); $i++) {
                        DetailProject::create([
                            'project_id' => $project->first()->id,
                            'category_id' => $request->category[$i]
                        ]);
                    }
                }

            }
            
            if (!empty($request->file('imgSlider'))) {
                $pathImgSlider = "public/files/project/img-slider";
                for ($imgs=0; $imgs < count($request->file('imgSlider')); $imgs++) { 
                    $fnameImgSlider[$imgs] = Str::slug(Carbon::now()->format('Ymds-').$slug.'-'.($imgs+1)).".".$request->file('imgSlider')[$imgs]->getClientOriginalExtension();
                    $fpathImgSlider[$imgs] = $request->file('imgSlider')[$imgs]->storeAs($pathImgSlider, $fnameImgSlider[$imgs]);

                    $imgSlider[$imgs] = ImgSlider::create([
                        'title' => ($request->title_imgSlider[$imgs] != null)?$request->title_imgSlider[$imgs]:null,
                        'path' => $fpathImgSlider[$imgs]
                    ]);

                    $projSlider[$imgs] = ProjectSlider::create([
                        'img_slider_id' => $imgSlider[$imgs]->id,
                        'project_id' => $project->first()->id
                    ]);


                }
            }

            return response()->json([
                'message' => $msg,
                'project' => $project->first()->detail_projects
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
        $project = Project::where('slug', $slug)->first();
        $detailProject = DetailProject::where('project_id', $project->id);
        for ($i=0; $i < count($detailProject->get()); $i++) { 
            $detailProject->get()[$i]->delete();
        }
        $projSlider = $project->project_sliders;

        if (!empty($projSlider)) {
            for ($i=0; $i < count($projSlider) ; $i++) { 
                Storage::delete($projSlider[$i]->img_slider->path);
                $projSlider[$i]->img_slider->delete();
            }
        }

        $delete = $project->delete();
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

            
            $projects = Project::get();

            return DataTables::of($projects)->addColumn('category',function($row)
            {

                $cat = null;

                if(!empty($row->detail_projects)){
                    for ($i=0; $i < count($row->detail_projects); $i++) { 
                        $cat[$i] = $row->detail_projects[$i]->category;
                        
                    }
                }

                return $cat;

            })->addColumn('action', function ($row)
            {
                $link['edit'] = route('admin.project.edit', $row->slug);
                $link['delete'] = route('admin.project.destroy', $row->slug);
                $link['previewAsReader'] = route('admin.project.preview.asReader', $row->slug);

                return $link;
            })->addColumn('created_at', function ($row)
            {
                return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
            })->addIndexColumn()->make(true);
            // return view('layouts.tes', compact('projects'));
            // return view('pages.admin.projects.index');
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function previewAsReader($slug)
    {
        $project = Project::where([
            ['slug', '=', $slug]
        ])->first();
        
        if(empty($project)){
            return view('pages.guest.404');
        }

        $latestProjects = Project::orderBy('created_at', 'DESC')->paginate(4);

        return view('pages.guest.project.detail', [
            'project' => $project,
            'latestProjects' => $latestProjects
        ]);
    }

    public function destroyImgSlider($id)
    {
        try {
            $imgSlider = ImgSlider::findOrFail($id);


            $deleteData = $imgSlider->delete();

            if ($deleteData) {
                Storage::delete($imgSlider->path);
                return response()->json([
                    'id' => $id
                ], 200);
            }

            
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => "[Refresh Page !] Gambar sudah dihapus atau mungkin Gambar gagal dihapus !"
            ], 500);
        }   

        
    }
}
