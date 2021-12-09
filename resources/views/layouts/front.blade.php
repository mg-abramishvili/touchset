<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <meta name="description" content="@yield('description')">

        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        @auth
            <!--<div class="apanel">
                panel
            </div>-->
        @endauth

        <div id="app">
            <header>
                <div class="header-top">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="header-top-nav">
                                <nav>
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">О компании</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Доставка и оплата</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('page', ['slug' => 'contacts'], false) }}" class="nav-link">Контакты</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-top-search">
                                <form action="{{ route('product_search', [], false) }}">
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
                                <a href="{{ route('home', [], false) }}">
                                    <img src="/img/logo.svg" alt="">
                                </a>
                            </div>
                            <div class="header-bottom-catalog">
                                <a href="{{ route('categories', [], false) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <span>Каталог</span>
                                </a>
                            </div>
                            <div class="header-bottom-tel">
                                <div class="header-bottom-tel-wrapper">
                                    <div class="header-bottom-tel-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                        </svg>
                                    </div>
                                    <a href="tel:+7{!! substr(str_replace(array(' ', '-', '+'), '', App\Http\Controllers\SettingController::index()->tel), 1) !!}">
                                        <small>{{App\Http\Controllers\SettingController::index()->schedule}}</small>
                                        {{App\Http\Controllers\SettingController::index()->tel}}
                                    </a>
                                </div>
                            </div>
                            <div class="header-bottom-cart">
                                {{-- <mini-cart></mini-cart> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            @yield('content')

            <footer>
                <div class="container">
                    <div class="row">
                        <div class="footer-logo">
                            <a href="{{ route('home', [], false) }}">
                                <img src="/img/logo.svg" alt="TachLab - ТачЛаб">
                            </a>
                        </div>
                        <div class="footer-catalog">
                            <ul>
                                <li>
                                    <a href="#">Школы и ВУЗы</a>
                                </li>
                                <li>
                                    <a href="#">Музеи</a>
                                </li>
                                <li>
                                    <a href="#">Торговые центры</a>
                                </li>
                                <li>
                                    <a href="#">Детские сады</a>
                                </li>
                                <li>
                                    <a href="#">Мед. центры</a>
                                </li>
                                <li>
                                    <a href="#">Банки</a>
                                </li>
                                <li>
                                    <a href="#">Заводы и предприятия</a>
                                </li>
                                <li>
                                    <a href="#">Храмы, мечети, синагоги</a>
                                </li>
                                <li>
                                    <a href="#">Парки</a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-contacts">
                            <a href="tel:+7{!! substr(str_replace(array(' ', '-', '+'), '', App\Http\Controllers\SettingController::index()->tel), 1) !!}">
                                {{App\Http\Controllers\SettingController::index()->tel}}
                            </a>
                            <p>{{App\Http\Controllers\SettingController::index()->email}}</p>
                            <p>{{App\Http\Controllers\SettingController::index()->address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <hr>
                            © Tachlab @php echo date("Y"); @endphp
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        {{-- <script src="{{ mix('js/app.js') }}" type="text/javascript"></script> --}}
        @yield('scripts')
    </body>
</html>