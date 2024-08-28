<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', ['episodes' => $season->episodes]);
    }

    public function update(FormRequest $request, Season $season)
    {

        DB::transaction(function () use ($request, $season) {
            $watchedEpisodes = $request->episodes;

            Episode::where('season_id', $season->id)->update(['watched' => 0]);
            Episode::whereIn('id', $watchedEpisodes)->update(['watched' => 1]);
        });


        return to_route('episodes.index', $season->id);
    }
}
