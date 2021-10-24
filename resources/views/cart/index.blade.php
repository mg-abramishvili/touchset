@extends('layouts.front')
@section('title', 'Корзина')
@section('content')
<div class="cart-page">
    <div class="container mt-4">
        <h1 class="block-title block-page-title">Корзина</h1>

        @if(session('cart'))
            <cart></cart>
        @else
            <p>Корзина пуста.</p>
        @endif

    </div>
</div>
@endsection