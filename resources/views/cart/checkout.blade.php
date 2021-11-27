@extends('layouts.front')
@section('title', 'Оформление заказа')
@section('content')
<div class="cart-page">
    <div class="container mt-4">
        <h1 class="block-title block-page-title">Оформление заказа</h1>

        @if(session('cart'))
            <checkout></checkout>
        @endif

    </div>
</div>
@endsection