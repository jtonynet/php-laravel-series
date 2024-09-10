<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Requests\UploadImageRequest;

/*
TODO: Broken change entre o laravel 10 e 11 a controller default
nao possui mais o metodo 'middleware' portando  estou  usando  a 
outra versao como BaseController. Verificar por outras  solucoes
https://laracasts.com/discuss/channels/laravel/middleware-in-laravel-11-inside-the-controller
*/
use Illuminate\Routing\Controller as BaseController;

class UploadImageController extends BaseController
{
    const ALLOWED_PATHS = ['series_cover'];

    public function upload(UploadImageRequest $request)
    {
        $path = $request->query('path');
        if (!in_array($path, self::ALLOWED_PATHS))
            return response()
                ->json(['msg' => 'not allowed path'], Response::HTTP_BAD_REQUEST);

        $imgFile = $request->file('img')?->store($path, 'public');

        return response()
            ->json(['file' => $imgFile], Response::HTTP_CREATED);
    }
}
