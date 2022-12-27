<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Currency App</title>
    </head>
    <body>
        <h1>Currency App</h1>
        <div>
            Witaj w aplikacji Currency App.
            Aplikacja pozwala na:
            <ul>
                <li>Pobieranie danych dot. kursów walut z API NBP i zapisywanie ich do bazy danych</li>
                <li>Wyświetlanie danych dot. kursów walut z bazy danych.</li>
            </ul>
        </div>
        <div style="padding-bottom: 20px;">
            <a href="{{ route('currencies.fetch') }}">Pobierz dane z API</a><br>
            <a href="{{ route('currencies.index') }}">Wyświetl dane z bazy danych</a>
        </div>
        <div style="background-color: black; padding: 1px; margin-bottom: 20px;"></div>
        <div>
            @yield('content')
        </div>
    </body>
</html>
