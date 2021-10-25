@extends('layouts.front')
@section('title', $product->name)
@section('description', $product->description)
@section('content')
<div class="product-page mt-4">
    <div class="container">
        
        <div class="breadcrumb">
            <a href="{{ route('categories') }}">Каталог</a>
            &nbsp;>&nbsp;
            @foreach($product->categories as $category)
                @if($category->parent)
                    <a href="{{ route('category_item', ['id' => $category->parent->id]) }}">{{ $category->parent->name }}</a>
                    &nbsp;>&nbsp;
                @endif
                <a href="{{ route('category_item', ['id' => $category->id]) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                @if($product->gallery)
                    <div class="row">
                        <div class="col-3">
                            <div class="swiper ProductGallerySwiperMini">
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
                <h1>{{ $product->name }}</h1>

                {!! $product->description !!}
                
                <p class="price"><span>{{ $product->price }}</span> ₽</p>

                <!--<a href="{{ route('add_to_cart', $product->id) }}">В корзину</a>-->
                <add-to-cart :product_id="{{ $product->id }}"></add-to-cart>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 offset-3">
                <table class="table">
                    @foreach($product->attributes as $attribute)
                        <tr>
                            <td>{{$attribute->name}}</td>
                            <td>{{$attribute->pivot->value}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="another-products bg-light">
        <div class="container">
            <h5 class="block-title block-page-title">Похожие товары</h5>
            <div class="row">
                @foreach($other_products as $op)
                    @if($op->id != $product->id)
                        <div class="col-12 col-md-4">
                            <div class="page-products-item">
                                <a href="{{ route('product_item', ['id' => $op->id ]) }}">
                                    @if($op->gallery)
                                        @foreach($op->gallery as $pg)
                                            @if($loop->first)
                                                <div class="page-products-item-image" style="background-image: url({{ $pg }})"></div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="page-products-item-image" style="background-image: url(/img/no-image.jpg)"></div>
                                    @endif

                                    <p>{{ $op->name }}</p>

                                    <span>{{ $op->price }} <i>₽</i></span>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var swiper = new Swiper('.ProductGallerySwiperMini', {
        slidesPerView: 4,
        spaceBetween: 10,
        direction: "vertical",
    });

    var swiper2 = new Swiper('.ProductGallerySwiper', {
        loop: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        thumbs: {
            swiper: swiper,
        },
    });
</script>
@endsection