<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSkills = Skill::count();
        $totalProjects = Project::count();
        $totalExperiences = Experience::count();

        return view('admin.dashboard.index', compact('totalSkills', 'totalProjects', 'totalExperiences'));
    }
}
