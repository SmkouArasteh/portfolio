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

        $icons = [
            'github'    => 'fab fa-github',
            'linkedin'  => 'fab fa-linkedin-in',
            'twitter'   => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'telegram'  => 'fab fa-telegram-plane',
        ];

        $socialLinks = [];
        foreach (['github', 'linkedin', 'twitter', 'instagram', 'telegram'] as $name) {
            if (!empty($settings->$name)) {
                $socialLinks[] = (object)[
                    'url'  => $settings->$name,
                    'icon' => $icons[$name],
                ];
            }
        }

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
