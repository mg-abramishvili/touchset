<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <meta name="description" content="@yield('description')">
		<meta name="robots" content="max-image-preview:large" />
		<link rel="canonical" href="https://tachlab.ru/product/17-vstraivaemyj-sensornyj-monitor/" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:site_name" content="Tachlab - сенсорные мониторы купить по цене производителя" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="17″ Встраиваемый сенсорный монитор - сенсорные мониторы купить по цене производителя " />
		<meta property="og:description" content="Tachlab - Компания Тач лаб предоставляет возможность купить сенсорный монитор 17 дюймов по цене производителя из наличия оптом и в розницу. На нашем складе всегда присутствуют ходовые модели интерактивных мониторов. Уточнить актуальную цену, условия покупки и доставки встраиваемого монитора 17” вы можете по телефону или отправить заявку на почту info@tachlab.ru. Звоните бесплатно по всей России по телефону […]" />
		<meta property="og:url" content="https://tachlab.ru/product/17-vstraivaemyj-sensornyj-monitor/" />
		<meta property="article:published_time" content="2021-10-19T10:09:46+00:00" />
		<meta property="article:modified_time" content="2021-11-30T09:52:03+00:00" />
		<meta property="article:publisher" content="https://www.facebook.com/dreamapp.ru" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:domain" content="tachlab.ru" />
		<meta name="twitter:title" content="17″ Встраиваемый сенсорный монитор - сенсорные мониторы купить по цене производителя " />
		<meta name="twitter:description" content="Tachlab - Компания Тач лаб предоставляет возможность купить сенсорный монитор 17 дюймов по цене производителя из наличия оптом и в розницу. На нашем складе всегда присутствуют ходовые модели интерактивных мониторов. Уточнить актуальную цену, условия покупки и доставки встраиваемого монитора 17” вы можете по телефону или отправить заявку на почту info@tachlab.ru. Звоните бесплатно по всей России по телефону […]" />

        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="/css/style.css"/>
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
                                            <a href="/" class="nav-link">О компании</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/categories" class="nav-link">Доставка и оплата</a>
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
        
        <script src="{{ asset('/js/app.js') }}"></script>
        {{-- <script src="/js/swiper-bundle.min.js"></script>
        @yield('scripts') --}}
    </body>
</html>