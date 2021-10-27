<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
        <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
        <link href="/css/style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div class="admin_panel bg-light" style="min-height: 100vh;">
            <div id="app">
                <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
                    <a href="{{ route('admin_home') }}" class="navbar-brand col-md-3 col-lg-2 me-0 px-3">TachLab ПУ</a>
                    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="subheader w-100 px-md-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                @yield('title')
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                @hasSection('add_button')
                                    <a href="@yield('add_button')" class="btn btn-sm btn-primary">Добавить</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </header>

                <div class="container-fluid">
                    <div class="row">
                        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                            <div class="position-sticky pt-3">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin_products') }}" class="nav-link">Товары</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin_categories') }}" class="nav-link">Категории</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin_pages') }}" class="nav-link">Страницы</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin_attributes') }}" class="nav-link">Настройки</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin_attributes') }}" class="nav-link">Атрибуты</a>
                                    </li>
                                </ul>

                                <ul class="nav flex-column mb-2">
                                    <li class="nav-item">
                                        <a href="/" class="nav-link">Выйти</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                                @yield('content')
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        @yield('scripts')
    </body>
</html>