<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\SeoService;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->paginate(12);
        $categories = ProjectCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('projects');

        return view('frontend.projects.index', compact('projects', 'categories', 'seo'));
    }

    public function show(string $slug): View
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $related = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->take(4)
            ->get();

        return view('frontend.projects.show', compact('project', 'related'));
    }

    public function category(string $slug): View
    {
        $category = ProjectCategory::where('slug', $slug)->firstOrFail();
        $projects = Project::where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        $categories = ProjectCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('projects');

        return view('frontend.projects.index', compact('projects', 'category', 'categories', 'seo'));
    }
}
