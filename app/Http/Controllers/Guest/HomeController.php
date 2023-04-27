<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Project;
use App\Models\SettingsTampilanHeaderHomepage;
use App\Models\SettingsTampilanOurClient as OurClient;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->paginate(3);
        $projects = Project::where('published', true)->paginate(4);
        $imgSlider = SettingsTampilanHeaderHomepage::get();
        $ourClients = OurClient::get();

        return view('pages.guest.homepage', [
            'posts' => $posts,
            'projects' => $projects,
            'imgSlider' => $imgSlider,
            'ourClients' => $ourClients
        ]);
    }
}
