<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $socialLinks = array_filter([
            'github'    => $settings->github,
            'linkedin'  => $settings->linkedin,
            'twitter'   => $settings->twitter,
            'instagram' => $settings->instagram,
            'telegram'  => $settings->telegram,
        ]);
        return view('Portfolio.home', [
            'about'       => About::first(),
            'projects'    => Project::where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'skills'      => Skill::orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('start_date', 'desc')->get(),
            'educations'  => Education::orderBy('start_date', 'desc')->get(),
            'settings'    => $settings,
            'socialLinks' => $socialLinks,
        ]);
    }
}
