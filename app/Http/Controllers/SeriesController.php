<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Throw_;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository) {}

    public function index(Request $request)
    {
        // Code Snipet
        // if (!Auth::check()) {
        //     throw new AuthenticationException();
        // }

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
        $series = $this->repository->add($request);

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
