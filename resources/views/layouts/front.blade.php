<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="@yield('description')">

        <title>@yield('title')</title>
        
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
        <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="/css/style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div id="app">
        <header>
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="header-top-tel">
                            <a>info@tachlab.ru</a>
                            <a href="tel:+78002002302">+7 800 200 23 02</a>
                        </div>
                        <div class="header-top-search">
                            <input type="text" class="form-control" placeholder="Поиск по магазину...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="header-bottom-logo">
                            <a href="{{ route('home') }}">
                                <img src="http://localhost/img/logo.svg" alt="TachLab - ТачЛаб">
                            </a>
                        </div>
                        <div class="header-bottom-nav">
                            <nav>
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="{{ route('categories') }}" class="nav-link">Магазин</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('contacts') }}" class="nav-link">Контакты</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-bottom-cart">
                            <minicart></minicart>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        @yield('content')
        </div>
        
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        @yield('scripts')
    </body>
</html>