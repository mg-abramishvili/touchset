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

<div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-12 col-md-4 border mb-4">
            <a href="#">{{ $product->name }}</a>
            <br/>
            {{ $product->price }} руб.
        </div>
        @endforeach
    </div>
</div>

@endsection