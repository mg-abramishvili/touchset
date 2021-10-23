<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TachLab</title>
        
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
        <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="/css/style.css" type="text/css" rel="stylesheet"/>
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    </head>
    <body>
        @yield('content')
        
        @yield('scripts')
    </body>
</html>