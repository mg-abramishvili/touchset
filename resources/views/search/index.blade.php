@extends('layouts.front')
@section('content')

<div class="container mt-4">
    <h1 class="block-title block-page-title">Поиск</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-md-4">
                <div class="page-products-item">
                    <a href="{{ route('product_item', ['id' => $product->id ]) }}">
                        @if($product->gallery)
                            @foreach($product->gallery as $pg)
                                @if($loop->first)
                                    <div class="page-products-item-image" style="background-image: url({{ $pg }})"></div>
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
</div>

@endsection