@props(['name'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/style.css'])
</head>

<body>

    <div>
        <x-layout.header :name="$name" />
        <main>
            {{ $slot }}
        </main>
        <footer>
            <p>Agenda de pedidos, derechos reservados {{ date('Y') }}</p>
            <p>desarrollado por Antuvio Digital</p>
        </footer>
    </div>

    <style>
        main {
            min-height: 100vh;
            margin: 0 100px;
        }

        footer {
            display: flex;
            justify-content: space-around;
            background-color: #686868;
            color: #fafafa;
        }
    </style>
</body>

</html>