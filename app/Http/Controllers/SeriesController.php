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
        $series = $this->repository->add($request);

        foreach (User::all() as $index => $user) {
            $email = new SeriesCreated(
                $series->nome,
                $series->id,
                $request->seasonsQty,
                $request->episodesPerSeason,
            );

            /*
            TODO:

            Nosso cliente smtp so aceite enviar 5  emails  a cada segundo
            Uma solucao possivel para contornar essa caracteristica seria
            enfileirar os emails e rodar o worker com  2  retentativas  a 
            cada 10 segundos:

            Mail::to($user)->queue($email);

            worker levantado com:
            php artisan queue:work --tries=2 --delay=10

            Mas dependeriamos do worker e ainda poderia ocorrer o deadlock.
            Outra   alternativa   com   `later`  se   encontra  abaixo  com 
            processamento agendado:
            */

            $when = now()->addSeconds($index * 2);
            Mail::to($user)->later($when, $email);

            /*
            Honestamente, nao gostei de nenhuma das duas alternativas dadas 
            pelo instrutor. Pesquisarei mais. A alternativa acima nao reduz 
            a necessidade de delay e retentativas, um hibrido de ambas pode
            ser coerente. Pesquisar mais sobre cenarios!
            */
        }

        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
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
