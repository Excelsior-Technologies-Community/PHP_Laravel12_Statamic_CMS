<?php

namespace App\Widgets;

use Statamic\Widgets\Widget;
use Statamic\Facades\Entry;
use App\Models\User;

class DashboardMetrics extends Widget
{
    public function html()
    {
        $totalUsers = User::count();
        $totalProjects = Entry::whereCollection('projects')->count();
        $activeProjects = Entry::whereCollection('projects')->filter(function ($entry) {
            return $entry->get('status') === 'active';
        })->count();

        return view('widgets.dashboard_metrics', [
            'totalUsers' => $totalUsers,
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
        ]);
    }
}