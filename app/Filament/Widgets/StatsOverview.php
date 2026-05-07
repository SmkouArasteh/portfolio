<?php

namespace App\Filament\Widgets;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $projects = Project::where('is_published', true)->count();
        $experience = Experience::count();
        $education = Education::count();

        return [
            Stat::make('Projects', $projects)
                ->description('Published projects')
                ->icon('heroicon-o-code-bracket')
                ->color('primary')
                ->url(route('filament.admin.resources.projects.index')),
            Stat::make('Experiences', $experience)
                ->description('All experiences')
                ->icon('heroicon-o-briefcase')
                ->color('success')
                ->url(route('filament.admin.resources.experiences.index')),
            Stat::make('Educations', $education)
                ->description('All educations')
                ->icon('heroicon-o-academic-cap')
                ->color('info')
                ->url(route('filament.admin.resources.education.index')),
        ];
    }

}