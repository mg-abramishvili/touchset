<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Touchset</title>
        
        <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="/css/style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        @yield('content')
        
        @yield('scripts')
    </body>
</html>