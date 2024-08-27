<html>
    <head>
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></link>
    </head>

    <body>
        <h1>{{ $title }}</h1>

        {{ $slot }}
    </body>
</html>