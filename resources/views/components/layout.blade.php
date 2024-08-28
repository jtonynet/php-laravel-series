<html>
    <head>
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></link>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('series.index') }}">Series</a>

                @auth
                <a href="{{ route('signout') }}">Sair</a>
                @endauth

                @guest
                <a href="{{ route('login') }}">Entrar</a>
                @endguest

            </div>
        </nav>

        <div class="container">
        <h1>{{ $title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
        @endisset

        {{ $slot }}
        </div>
    </body>
</html>