<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\User;
use App\Repositories\SeriesRepository;

/*
TODO: Broken change entre o laravel 10 e 11 a controller default
nao possui mais o metodo 'middleware' portando  estou  usando  a 
outra versao como BaseController. Verificar por outras  solucoes
https://laracasts.com/discuss/channels/laravel/middleware-in-laravel-11-inside-the-controller
*/
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class SeriesController extends BaseController
{

    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

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
        $coverPath = $request->file('cover')?->store('series_cover', 'public');

        /* TODO: alternativa pois minha  seriesRepository
        manipula diretamente meu FormRequest e a model
        quando deveria conhecer uma classe  de dominio
        chamada `series`. REVER NO FUTURO*/
        $request->coverPath = $coverPath;

        $series = $this->repository->add($request);

        \App\Events\SeriesCreated::dispatch(
            $series->nome,
            $series->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        if (!is_null($series->cover))
            \App\Events\DeleteSeriesCover::dispatch($series->cover);

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
