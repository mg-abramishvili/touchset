@extends('layouts.front')
@section('title', 'Заголовок')
@section('description', 'Описание')
@section('content')
<div class="category-page">
    <div class="container mt-4">
        <h1 class="block-title block-page-title">Каталог</h1>
        
        <div class="row">
            @foreach($categories as $category)
                @if(!$category->parent)
                <div class="col-12 col-md-4">
                    <div class="category-item">
                        <a href="{{ route('category_item', ['id'=> $category->id]) }}">
                            <div class="category-item-image" style="@if($category->image) background-image:url({{ $category->image }}) @else background-image:url(/img/no-image.jpg) @endif"></div>
                            <h3>{{ $category->name }}</h3>
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection