<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Message;
use App\Models\Product;
use App\Models\Project;
use App\Models\Visitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Produk tersedia')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Project', Project::count())
                ->description('Project selesai')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success')
                ->chart([3, 5, 8, 5, 10, 12, 15]),

            Stat::make('Total Artikel', Article::count())
                ->description('Artikel dipublikasi')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning')
                ->chart([2, 4, 6, 5, 7, 9, 11]),

            Stat::make('Total Pesan', Message::count())
                ->description('Pesan masuk')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color('danger')
                ->chart([1, 3, 2, 4, 3, 5, 4]),

            Stat::make('Visitor Hari Ini', Visitor::whereDate('created_at', today())->count())
                ->description('Pengunjung baru')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Visitor Bulan Ini', Visitor::whereMonth('created_at', now()->month)->count())
                ->description('Total pengunjung')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),
        ];
    }
}
