<html>
    <head>
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></link>
    </head>

    <body>
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

        {{ $slot }}
        </div>
    </body>
</html>