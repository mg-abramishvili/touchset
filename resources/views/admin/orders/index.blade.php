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
                    <td>Допы</td>
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
                                {{ $orderItem->product->price }}
                                <ul>
                                    @foreach($orderItem->addons as $addon)
                                        {{ $addon->name }}, {{ $addon->pivot->price }}
                                    @endforeach
                                </ul>
                            @endforeach
                        </td>
                        <td>

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