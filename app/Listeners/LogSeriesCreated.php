<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreated $event): void
    {
        Log::info("Serie '{$event->seriesName}' criada com sucesso");
    }
}
