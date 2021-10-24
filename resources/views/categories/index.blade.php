@extends('layouts.front')
@section('title', 'Заголовок')
@section('description', 'Описание')
@section('content')
<div class="category-page">
    <div class="container mt-4">
        <h1>Каталог</h1>
        
        <div class="row">
            @foreach($categories as $category)
                @if(!$category->parent)
                <div class="col-12 col-md-4">
                    <a href="{{ route('category_item', ['id'=> $category->id]) }}">{{ $category->name }}</a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection