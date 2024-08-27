<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {

        $series = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $season[] = [
                'series_id' => $series->id,
                'number' => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '$series->nome' atualizada com sucesso");
    }
}
