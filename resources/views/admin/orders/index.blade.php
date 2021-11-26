@extends('layouts.admin')
@section('title', 'Заказы')
@section('content')
<div class="w-100">
    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <td>Номер заказа</td>
                    <td>Позиции</td>
                    <td>Стоимость</td>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            {{ $order->id }}
                        </td>
                        <td>
                            @foreach($order->orderItems as $orderItem)
                                {{ $orderItem->product->name }}
                                <ul>
                                    @foreach($orderItem->addons as $addon)
                                        <li>+ {{ $addon->name }} <!--, {{ number_format($addon->pivot->price, 0, ',', ' ') }} руб.--></li>
                                    @endforeach
                                </ul>
                                <br>
                            @endforeach
                        </td>
                        <td class="text-end">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection