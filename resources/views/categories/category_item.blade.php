@extends('layouts.front')
@section('title', 'Заголовок')
@section('description', 'Описание')
@section('content')

<div class="container mt-4">
    <h1>{{ $category->name }}</h1>

    <div class="row">
        @foreach($subcategories as $subcategory)
            <div class="col-12 col-md-4">
                <a href="{{ route('category_item', ['id'=> $subcategory->id]) }}">{{ $subcategory->name }}</a>
            </div>
        @endforeach
    </div>

    @if($products->count() > 0)
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-md-4">
                <a href="{{ route('product_item', ['id' => $product->id]) }}">{{ $product->name }}</a>
            </div>
        @endforeach
    </div>
    @endif
</div>

@endsection