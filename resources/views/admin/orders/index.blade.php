@extends('layouts.admin')
@section('title', 'Заказы')
@section('content')
<div class="w-100">
    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <td>Дата</td>
                    <td style="text-align: center;">Номер заказа</td>
                    <td>Заказ</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td style="width: 120px;">
                            {{ \Carbon\Carbon::parse($order->created_at)->locale('ru')->isoFormat('DD.MM.YYYY')}}
                        </td>
                        <td style="width: 200px; text-align: center;">
                            {{ $order->id }}
                        </td>
                        <td>
                            @foreach($order->orderItems as $orderItem)
                                    <p class="table-order-item">
                                    {{ $orderItem->product->name }}
                                    
                                    @if($orderItem->addons->count() > 0)
                                        + допы
                                    @endif
                                </p>
                            @endforeach
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin_order', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-primary">Детали</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection