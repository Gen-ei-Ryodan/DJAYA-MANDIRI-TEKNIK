<div class="space-y-6">
    <div class="grid grid-cols-3 gap-4">
        {{-- Total Pages --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <x-filament::icon icon="heroicon-o-document-text" class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($this->totalPages) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Halaman</p>
                </div>
            </div>
        </div>

        {{-- Healthy Pages --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-success-100 dark:bg-success-900/30 flex items-center justify-center">
                    <x-filament::icon icon="heroicon-o-check-circle" class="w-5 h-5 text-success-600 dark:text-success-400" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-success-600 dark:text-success-400">{{ number_format($this->healthyPages) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Sehat</p>
                </div>
            </div>
        </div>

        {{-- Issues --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-danger-100 dark:bg-danger-900/30 flex items-center justify-center">
                    <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-5 h-5 text-danger-600 dark:text-danger-400" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-danger-600 dark:text-danger-400">{{ number_format($this->totalIssues) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Masalah</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Health Score --}}
    @php $healthScore = $this->totalPages > 0 ? round(($this->healthyPages / $this->totalPages) * 100) : 0; @endphp
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">SEO Health Score</h3>
            <span class="text-2xl font-bold @if($healthScore >= 80) text-success-600 @elseif($healthScore >= 50) text-warning-600 @else text-danger-600 @endif">
                {{ $healthScore }}%
            </span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="h-2.5 rounded-full transition-all duration-500 @if($healthScore >= 80) bg-success-500 @elseif($healthScore >= 50) bg-warning-500 @else bg-danger-500 @endif"
                 style="width: {{ $healthScore }}%"></div>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
            @if($healthScore >= 80) SEO Anda dalam kondisi baik.
            @elseif($healthScore >= 50) Ada beberapa area yang perlu diperbaiki.
            @else Banyak halaman yang memerlukan perbaikan SEO segera.
            @endif
        </p>
    </div>

    {{-- Report Table --}}
    @if(!empty($this->report))
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Detail Masalah SEO</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left px-4 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tipe</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Halaman</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Masalah</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Severity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->report as $item)
                    <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                {{ $item['type'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $item['name'] }}</div>
                            @if(isset($item['url']))
                            <a href="{{ $item['url'] }}" target="_blank" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">Lihat Halaman</a>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($item['issues'] as $issue)
                                <li class="text-xs text-gray-600 dark:text-gray-400">{{ $issue }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-4 py-3">
                            @if($item['severity'] === 'critical')
                            <span class="text-xs px-2 py-0.5 rounded-full bg-danger-100 dark:bg-danger-900/30 text-danger-700 dark:text-danger-400 font-medium">Critical</span>
                            @else
                            <span class="text-xs px-2 py-0.5 rounded-full bg-warning-100 dark:bg-warning-900/30 text-warning-700 dark:text-warning-400 font-medium">Warning</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
        <x-filament::icon icon="heroicon-o-check-circle" class="w-12 h-12 text-success-500 mx-auto mb-3" />
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak Ada Masalah Ditemukan</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Semua halaman sudah memiliki SEO yang baik.</p>
    </div>
    @endif
</div>