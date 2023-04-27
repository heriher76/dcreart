<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SettingsTampilanHeaderHomepage;

use Storage;

class ContactController extends Controller
{
    public function index()
    {
        $firstSlider = SettingsTampilanHeaderHomepage::first();
        
        return view('pages.guest.contact.index', [
            'firstSlider' => $firstSlider
        ]);
    }
}
