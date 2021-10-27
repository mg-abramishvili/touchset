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
        <link href="https://unpkg.com/swiper@7/swiper-bundle.min.css" rel="stylesheet" />
        <link href="/css/style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div id="app">
            <header>
                <div class="header-top">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="header-top-nav">
                                <nav>
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="{{ route('categories') }}" class="nav-link">Магазин</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('page', ['slug' => 'contacts']) }}" class="nav-link">Контакты</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-top-search">
                                <form action="{{ route('product_search') }}">
                                    <input name="search" type="text" class="form-control" placeholder="Поиск по магазину..." required>
                                    <input type="submit" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="header-top">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="header-top-tel">
                                <a>{{App\Http\Controllers\SettingController::index()->email}}</a>
                                <a href="tel: +7{!! substr(str_replace(array(' ', '-', '+'), '', App\Http\Controllers\SettingController::index()->tel), 1) !!}">
                                    {{App\Http\Controllers\SettingController::index()->tel}}
                                </a>
                            </div>
                            <div class="header-top-search">
                                <form action="{{ route('product_search') }}">
                                    <input name="search" type="text" class="form-control" placeholder="Поиск по магазину..." required>
                                    <input type="submit" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="header-bottom-logo">
                                <a href="{{ route('home') }}">
                                    <img src="/img/logo.svg" alt="TachLab - ТачЛаб">
                                </a>
                            </div>
                            <div class="header-bottom-nav">
                                <nav>
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="{{ route('categories') }}" class="nav-link">Магазин</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('page', ['slug' => 'contacts']) }}" class="nav-link">Контакты</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-bottom-cart">
                                <a href="{{ route('cart') }}">
                                    <minicart></minicart>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>-->
            </header>
            
            @yield('content')

            <footer>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}">
                                <img src="/img/logo-w.svg" alt="TachLab - ТачЛаб">
                            </a>
                        </div>
                        <div class="footer-mail">
                            {{App\Http\Controllers\SettingController::index()->email}}
                        </div>
                        <div class="footer-tel">
                            <a href="tel: +7{!! substr(str_replace(array(' ', '-', '+'), '', App\Http\Controllers\SettingController::index()->tel), 1) !!}">
                                {{App\Http\Controllers\SettingController::index()->tel}}
                            </a>
                        </div>
                        <div class="footer-address">
                            {{App\Http\Controllers\SettingController::index()->address}}
                        </div>
                        <div class="footer-schedule">
                            {{App\Http\Controllers\SettingController::index()->schedule}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center" style="color: #ccc;">
                            <hr>
                            © Tachlab @php echo date("Y"); @endphp
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
        @yield('scripts')
    </body>
</html>