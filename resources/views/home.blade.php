@extends('layouts.front')
@section('title', 'ТачЛаб')
@section('content')

<div class="home-carousel">
    <div class="container">
        <div class="home-carousel-inner">
            <h1>Сенсорные киоски <br/>и мониторы</h1>
            <a href="{{ route('categories') }}" class="btn btn-standard">В каталог</a>
        </div>
    </div>
</div>

<div class="home-products-block">
    <div class="container">
        <h5 class="block-title">Новинки</h5>
        <div class="row">
            @foreach($products_is_new as $product)
                <div class="col-12 col-md-3 mb-4">
                    <div class="home-products-item">
                        <a href="{{ route('product_item', ['id' => $product->id ]) }}">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <div class="home-products-item-image" style="background-image: url({{ $pg }})"></div>
                                    @endif
                                @endforeach
                            @endif
                            <span>
                                <strong>
                                    @php
                                        echo number_format($product->price,0,","," ");
                                    @endphp
                                </strong> <i>₽</i>
                            </span>
                            <p>{{ $product->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('categories') }}" class="btn btn-standard">Перейти в каталог</a>
        </div>
    </div>
</div>

<div class="home-preim">
    <div class="container">
        <h5 class="block-title">Наши преимущества</h5>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="home-preim-item">
                    <p>
                        <span>01</span>
                        <strong>Надежность</strong>
                        <small>Работаем с 2009 года</small>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="home-preim-item">
                    <p>
                        <span>02</span>
                        <strong>Надежность</strong>
                        <small>Работаем с 2009 года</small>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="home-preim-item">
                    <p>
                        <span>03</span>
                        <strong>Надежность</strong>
                        <small>Работаем с 2009 года</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-products-block">
    <div class="container">
        <h5 class="block-title">Популярное</h5>
        <div class="row">
            @foreach($products_is_new as $product)
                <div class="col-12 col-md-3 mb-4">
                    <div class="home-products-item">
                        <a href="{{ route('product_item', ['id' => $product->id ]) }}">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <div class="home-products-item-image" style="background-image: url({{ $pg }})"></div>
                                    @endif
                                @endforeach
                            @endif
                            <span>
                                <strong>
                                    @php
                                        echo number_format($product->price,0,","," ");
                                    @endphp
                                </strong> <i>₽</i>
                            </span>
                            <p>{{ $product->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('categories') }}" class="btn btn-standard">Перейти в каталог</a>
        </div>
    </div>
</div>

<div class="home-categories">
    <div class="container">
        <h5 class="block-title">Каталог товаров</h5>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-12 col-md-4">
                    <div class="home-categories-item">
                        <a href="{{ route('category_item', ['id' => $category->id]) }}">
                            <h3>{{ $category->name }}</h3>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="home-products-block">
    <div class="container">
        <h5 class="block-title">Лучшая цена</h5>
        <div class="row">
            @foreach($products_is_new as $product)
                <div class="col-12 col-md-3 mb-4">
                    <div class="home-products-item">
                        <a href="{{ route('product_item', ['id' => $product->id ]) }}">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <div class="home-products-item-image" style="background-image: url({{ $pg }})"></div>
                                    @endif
                                @endforeach
                            @endif
                            <span>
                                <strong>
                                    @php
                                        echo number_format($product->price,0,","," ");
                                    @endphp
                                </strong> <i>₽</i>
                            </span>
                            <p>{{ $product->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('categories') }}" class="btn btn-standard">Перейти в каталог</a>
        </div>
    </div>
</div>

@endsection