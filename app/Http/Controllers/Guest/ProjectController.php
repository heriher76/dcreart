<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\ProjectSlider;
use App\Models\SettingsTampilanHeaderHomepage;

use Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $firstSlider = SettingsTampilanHeaderHomepage::first();
        $projects = Project::where('published', true)->paginate(6);
        return view('pages.guest.project.index',[
            'projects' => $projects,
            'firstSlider' => $firstSlider
        ]);
    }

    public function show($slug)
    {
        $project = Project::with(['project_sliders.img_slider'])->where([
            ['slug', '=', $slug], ['published', '=', true]
            ])->firstOrFail();
            
        // return $project;
        // if(empty($project)){
        //     return view('pages.guest.404');
        // }

        $latestprojects = Project::where('published', true)->orderBy('published_at', 'DESC')->paginate(3);
        return view('pages.guest.project.detail', [
            'project' => $project,
            'latestprojects' => $latestprojects
        ]);
    }
}
