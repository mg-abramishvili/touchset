@extends('layouts.front')
@section('content')

<div class="container mt-4">
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-md-4">
                <a href="{{ route('product_item', ['id' => $product->id]) }}">{{ $product->name }}</a>
            </div>
        @endforeach
    </div>
</div>

@endsection