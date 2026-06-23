<?php

namespace App\Jobs;

use App\Models\Visitor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TrackVisitorJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly ?string $ip,
        private readonly ?string $userAgent,
        private readonly string $page,
        private readonly ?string $referrer,
    ) {}

    public function handle(): void
    {
        Visitor::create([
            'ip' => $this->ip,
            'user_agent' => $this->userAgent,
            'page' => $this->page,
            'referrer' => $this->referrer,
        ]);
    }
}
