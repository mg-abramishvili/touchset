@extends('layouts.front')
@section('title', $product->name)
@section('description', $product->description)
@section('content')

<div class="container mt-4">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->price }}</p>

    <button @click="testMethod()" class="btn btn-standard">В корзину</button>
</div>

@endsection