<?php

namespace App\Filament\Pages;

use App\Models\Article;
use App\Models\City;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class SeoAnalyzer extends Page
{
    protected static ?string $navigationIcon = Heroicon::OutlinedChartBarSquare;

    protected static string $view = 'filament.pages.seo-analyzer';

    protected static ?string $navigationLabel = 'SEO Analyzer';

    protected static ?string $navigationGroup = 'SEO & Konten';

    protected static ?int $navigationSort = 0;

    public array $report = [];

    public int $totalIssues = 0;

    public int $totalPages = 0;

    public int $healthyPages = 0;

    public function mount(): void
    {
        $this->runAnalysis();
    }

    public function runAnalysis(): void
    {
        $this->report = [];
        $this->totalIssues = 0;
        $this->totalPages = 0;
        $this->healthyPages = 0;

        // Analyze static pages (SeoMeta)
        $this->analyzeSeoMetas();

        // Analyze articles
        $this->analyzeCollection('Artikel', Article::class, ['seo_title', 'seo_description'], [
            'title' => fn ($m) => $m->title,
            'edit_url' => fn ($m) => route('filament.admin.resources.articles.edit', $m),
        ]);

        // Analyze products
        $this->analyzeCollection('Produk', Product::class, ['seo_title', 'seo_description'], [
            'title' => fn ($m) => $m->name,
            'edit_url' => fn ($m) => route('filament.admin.resources.products.edit', $m),
        ]);

        // Analyze projects
        $this->analyzeCollection('Project', Project::class, ['seo_title', 'seo_description'], [
            'title' => fn ($m) => $m->title,
            'edit_url' => fn ($m) => route('filament.admin.resources.projects.edit', $m),
        ]);

        // Analyze services
        $this->analyzeCollection('Layanan', Service::class, [], [
            'title' => fn ($m) => $m->title,
            'edit_url' => fn ($m) => route('filament.admin.resources.services.edit', $m),
        ]);

        // Analyze city landing pages
        $this->analyzeCities();
    }

    protected function analyzeSeoMetas(): void
    {
        $pages = \App\Models\SeoMeta::all();
        $this->totalPages += $pages->count();
        $hasIssues = 0;

        foreach ($pages as $page) {
            $issues = [];

            if (empty($page->meta_title)) {
                $issues[] = 'Meta title kosong';
            }
            if (empty($page->meta_description)) {
                $issues[] = 'Meta description kosong';
            }
            if (strlen($page->meta_description ?? '') > 160) {
                $issues[] = 'Meta description terlalu panjang (' . strlen($page->meta_description) . ' chars)';
            }
            if (empty($page->canonical_url)) {
                // canonical_url is optional, not critical
            }

            if (!empty($issues)) {
                $hasIssues++;
                $this->totalIssues += count($issues);
                $this->report[] = [
                    'type' => 'Halaman Statis',
                    'name' => $page->page,
                    'url' => url('/') . ($page->page !== 'home' ? '/' . $page->page : ''),
                    'issues' => $issues,
                    'severity' => $this->getSeverity($issues),
                ];
            }
        }

        $this->healthyPages += ($pages->count() - $hasIssues);
    }

    protected function analyzeCollection(string $label, string $modelClass, array $seoFields, array $context): void
    {
        $items = $modelClass::all();
        $this->totalPages += $items->count();
        $hasIssues = 0;

        foreach ($items as $item) {
            $issues = [];

            if (!empty($seoFields)) {
                $hasTitle = !empty($item->{$seoFields[0]});
                $hasDesc = !empty($item->{$seoFields[1]});

                if (!$hasTitle) {
                    $issues[] = 'SEO title tidak diisi (menggunakan default: ' . $context['title']($item) . ')';
                }
                if (!$hasDesc) {
                    $issues[] = 'SEO description tidak diisi';
                }
            }

            if (method_exists($item, 'thumbnail') && empty($item->thumbnail)) {
                $issues[] = 'Thumbnail/image tidak ada';
            }

            if (!empty($issues)) {
                $hasIssues++;
                $this->totalIssues += count($issues);
                $this->report[] = [
                    'type' => $label,
                    'name' => $context['title']($item),
                    'url' => url()->current(), // fallback
                    'edit_url' => $context['edit_url']($item),
                    'issues' => $issues,
                    'severity' => $this->getSeverity($issues),
                ];
            }
        }

        $this->healthyPages += ($items->count() - $hasIssues);
    }

    protected function analyzeCities(): void
    {
        $cities = City::all();
        $this->totalPages += $cities->count();
        $hasIssues = 0;

        foreach ($cities as $city) {
            $issues = [];

            if (empty($city->meta_title)) {
                $issues[] = 'SEO title tidak diisi';
            }

            if (!empty($issues)) {
                $hasIssues++;
                $this->totalIssues += count($issues);
                $this->report[] = [
                    'type' => 'Landing Page Kota',
                    'name' => $city->type . ' ' . $city->name,
                    'url' => route('city.landing', $city->slug),
                    'issues' => $issues,
                    'severity' => $this->getSeverity($issues),
                ];
            }
        }

        $this->healthyPages += ($cities->count() - $hasIssues);
    }

    protected function getSeverity(array $issues): string
    {
        $critical = ['Meta title kosong', 'Meta description kosong', 'SEO title tidak diisi', 'SEO description tidak diisi'];
        foreach ($issues as $issue) {
            if (in_array($issue, $critical)) {
                return 'critical';
            }
        }
        return 'warning';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Refresh Analisis')
                ->icon('heroicon-m-arrow-path')
                ->action('runAnalysis'),
        ];
    }
}