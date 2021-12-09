@extends('layouts.front')
@section('title', $product->meta_title)
@section('description', $product->meta_description)
@section('content')
<div class="product-page">
    <div class="container">
        
        <div class="breadcrumb">
            <a href="{{ route('categories') }}">Каталог</a>
            &nbsp;→&nbsp;
            @foreach($product->categories as $category)
                @if($category->parent)
                    @include('products.sub ', ['parent' => $category->parent])
                @endif
                <a href="{{ route('category_item', ['id' => $category->id]) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                @if($product->gallery)
                    <div class="row">
                        <div class="col-3">
                            <div class="swiper ProductGalleryMiniSwiper">
                                <div class="swiper-wrapper">
                                    @foreach($product->gallery as $galleryImage)
                                        <div class="swiper-slide" style="background-image: url({{$galleryImage}})"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="swiper ProductGallerySwiper">
                                <div class="swiper-wrapper">
                                    @foreach($product->gallery as $galleryImage)
                                        <div class="swiper-slide" style="background-image: url({{$galleryImage}})"></div>
                                    @endforeach
                                </div>
                                <!--<div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>-->
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <div class="product-details">
                    <h1>{{ $product->name }}</h1>

                    <div class="row product-tech">
                        @foreach($product->attributes as $attribute)
                            <div class="col-6 mb-3">
                                <span>
                                    <strong>{{$attribute->name}}:</strong><br>
                                    {{$attribute->pivot->value}}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <p class="price">
                        <span>
                            @php
                                echo number_format($product->price,0,","," ");
                            @endphp
                        </span> ₽
                    </p>
                    <add-to-cart :product_id="{{ $product->id }}"></add-to-cart>
                </div>
            </div>
        </div>

        <div class="product-description">
            <div class="row mt-4">
                <div class="col-8">
                    {!! $product->description !!}
                </div>
                <div class="col-4">
                    <product-addons :addons="{{ $product->addons }}"></product-addons>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="home-products-block home-products-block-bg">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <h5 class="block-title">Вам также может подойти</h5>
                    <div class="home-products-swiper-nav">
                        <div class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </div>
                        <div class="swiper-button-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="swiper HomeProductsSwiper">
                        <div class="swiper-wrapper">
                            @foreach($products_is_new as $aproduct)
                                @if($aproduct->id != $product->id)
                                <div class="swiper-slide">
                                    <div class="home-products-item">
                                        <a href="{{ route('product_item', ['id' => $aproduct->id ]) }}">
                                            @if($aproduct->gallery)
                                                @foreach($aproduct->gallery as $pg)
                                                    @if($loop->first)
                                                        <div class="home-products-item-image" style="background-image: url({{ $pg }})"></div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <span>
                                                <strong>
                                                    @php
                                                        echo number_format($aproduct->price,0,","," ");
                                                    @endphp
                                                </strong> <i>₽</i>
                                            </span>
                                            <p>{{ $aproduct->name }}</p>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    var swiper = new Swiper('.ProductGalleryMiniSwiper', {
        slidesPerView: 4,
        spaceBetween: 10,
        direction: 'vertical',
    });

    var swiper2 = new Swiper('.ProductGallerySwiper', {
        loop: false,
        spaceBetween: 1,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        thumbs: {
            swiper: swiper,
        },
    });

    var swiper3 = new Swiper('.HomeProductsSwiper', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 0,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endsection