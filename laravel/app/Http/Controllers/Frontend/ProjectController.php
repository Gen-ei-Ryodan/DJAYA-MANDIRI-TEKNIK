<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Support\Str;
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
        $settings = app(SettingService::class);
        $related = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->take(4)
            ->get();

        $metaTitle = ($project->seo_title ?? $project->title) . ' | ' . $settings->getCompanyName();
        $metaDescription = $project->seo_description ?? Str::limit(strip_tags($project->description), 160);
        $ogImage = $project->thumbnail ? asset('storage/' . $project->thumbnail) : $settings->getLogo();

        $breadcrumbSchema = json_encode([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Project', 'item' => route('projects')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $project->title, 'item' => url()->current()],
        ]);

        return view('frontend.projects.show', compact(
            'project', 'related',
            'metaTitle', 'metaDescription', 'ogImage',
            'breadcrumbSchema'
        ));
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
