@extends('layouts.front')
@section('title', 'Заголовок')
@section('description', 'Описание')
@section('content')

<div class="container mt-4">
    <h1>Каталог</h1>
    <example-component></example-component>
    
    <div class="row">
        @foreach($categories as $category)
        <div class="col-12 col-md-4">
            <a href="{{ route('category_item', ['id'=> $category->id]) }}">{{ $category->name }}</a>
        </div>
        @endforeach
    </div>
</div>

@endsection