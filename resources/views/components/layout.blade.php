<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Log Analyzer</title>
    </head>
    <body class="antialiased bg-gray-100">
        <div class="flex h-screen">
            {{ $slot }}
        </div>
    </body>
</html>
