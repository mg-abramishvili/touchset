@extends('layouts.admin')
@section('title', $product->name)
@section('content')
<div class="w-100">
    <product-edit :product_id="{{ $product->id }}"></product-edit>
</div>
@endsection