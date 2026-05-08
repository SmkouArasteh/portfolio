<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0))
        ->add(Url::create('/projects')->setPriority(0.8));

    Project::where('is_published', true)->each(function (Project $project) use ($sitemap) {
        $sitemap->add(
            Url::create("/projects/{$project->slug}")
                ->setLastModificationDate($project->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.7)
        );
    });

    return $sitemap->toResponse(request());
});