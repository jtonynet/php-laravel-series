<?php

namespace App\Listeners;


use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class EmailUsersAboutSeriesCreated
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
    public function handle(SeriesCreatedEvent $event): void
    {
        foreach (User::all() as $index => $user) {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );

            $when = now()->addSeconds($index * 2);
            Mail::to($user)->later($when, $email);
        }
    }
}
