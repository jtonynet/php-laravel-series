<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SeriesFormRequest;
use \App\Models\Series;
use Illuminate\Http\Response;
/*
TODO: Broken change entre o laravel 10 e 11 a controller default
nao possui mais o metodo 'middleware' portando  estou  usando  a 
outra versao como BaseController. Verificar por outras  solucoes
https://laracasts.com/discuss/channels/laravel/middleware-in-laravel-11-inside-the-controller
*/

use Illuminate\Routing\Controller as BaseController;

class SeriesController extends BaseController
{
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json(Series::create($request->all()), Response::HTTP_CREATED);
    }
}
