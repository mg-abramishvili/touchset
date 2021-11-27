@extends('layouts.admin')
@section('title', 'Заказ #' . $order->id)
@section('content')
  <div class="w-100">
    <div class="box px-4 py-4">
      <table class="table">
        <tbody>
          @foreach($order->orderItems as $orderItem)
            <tr>
              <td><strong>{{ $orderItem->product->name }}</strong></td>
              <td style="text-align: right;">{{ number_format($orderItem->product->price, 0, ',', ' ') }} руб.</td>
            </tr>
            @foreach($orderItem->addons as $addon)
            <tr>
              <td>{{ $orderItem->product->name }} {{ $addon->name }}</td>
              <td style="text-align: right;">{{ number_format($addon->pivot->price, 0, ',', ' ') }} руб.</td>
            </tr>
            @endforeach
          @endforeach
          <tr style="border-color: transparent;">
            <td style="text-align: right;">Итого:</td>
            <td style="text-align: right;">
              @php
              $products_sum = $order->orderItems->sum('product.price')
             @endphp
             @foreach($order->orderItems as $item)
               @php
                $addons_sum = $item->addons->sum('pivot.price')
               @endphp
             @endforeach
     
             <strong>{{ number_format($products_sum + $addons_sum, 0, ',', ' ') }}</strong> руб.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection