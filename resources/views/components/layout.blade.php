<html>
    <head>
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></link>
    </head>

    <body>
        <div class="container">
        <h1>{{ $title }}</h1>

        {{ $slot }}
        </div>
    </body>
</html>