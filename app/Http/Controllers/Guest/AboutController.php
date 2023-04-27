<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SettingsTampilanHeaderHomepage;
use App\Models\SettingsTampilanKontenAboutu as KontenAboutUs;
use App\Models\SettingsTampilanOurClient as OurClient;

use Storage;

class AboutController extends Controller
{
    public function index()
    {
        $firstSlider = SettingsTampilanHeaderHomepage::first();
        $kontenAboutUs = KontenAboutUs::first();
        $ourClients = OurClient::get();

        return view('pages.guest.about.index', [
            'firstSlider' => $firstSlider,
            'kontenAboutUs' => $kontenAboutUs,
            'ourClients' => $ourClients
        ]);
    }
}
