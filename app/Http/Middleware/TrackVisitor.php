<?php

namespace App\Http\Middleware;

use App\Jobs\TrackVisitorJob;
use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('admin*') && !$request->is('filament*') && !$request->is('livewire*')) {
            TrackVisitorJob::dispatch(
                ip: $request->ip(),
                userAgent: $request->userAgent(),
                page: $request->path(),
                referrer: $request->header('referer'),
            )->onQueue('low');
        }

        return $next($request);
    }
}
