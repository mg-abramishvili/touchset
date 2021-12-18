@extends('layouts.front')
@section('title', 'Заголовок')
@section('description', 'Описание')
@section('content')
<div class="category-page">
    <div class="container mt-4">
        <h1 class="block-title block-page-title">{{ $category->name }}</h1>

        <div class="row">
            @if($subcategories->count() > 0)
                @foreach($subcategories as $subcategory)
                    <div class="col-12 col-md-4">
                        <div class="category-item">
                            <a href="{{ route('category_item', ['slug'=> $subcategory->slug]) }}">
                                <div class="category-item-image" style="@if($category->image) background-image:url({{ $category->image }}) @else background-image:url(/img/no-image.jpg) @endif"></div>
                                <h3>{{ $subcategory->name }}</h3>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-md-4">
                    <div class="page-products-item">
                        <a href="{{ route('product_item', ['slug' => $product->slug ]) }}">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <div class="page-products-item-image" style="background-image: url({{ $pg }})"></div>
                                    @endif
                                @endforeach
                            @endif

                            <p>{{ $product->name }}</p>

                            <span>
                                @php
                                    echo number_format($product->price,0,","," ");
                                @endphp
                                <i>₽</i>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            @if(!$subcategories->count() > 0)
                <p>Категория пуста.</p>
            @endif
        @endif
    </div>
</div>
@endsection