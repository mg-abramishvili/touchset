@extends('layouts.front')
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
                <div class="col-12 col-md-4 mb-4">
                    <div class="home-products-item">
                        <a href="{{ route('product_item', ['id' => $product->id ]) }}">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <div class="home-products-item-image" style="background-image: url({{ $pg }})"></div>
                                    @endif
                                @endforeach
                            @endif

                            <p>{{ $product->name }}</p>

                            <span>{{ $product->price }} <i>₽</i></span>
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
    <div class="conatiner">
        <h5 class="block-title">Наши преимущества</h5>
    </div>
</div>

@endsection