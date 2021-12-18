@extends('layouts.admin')
@section('title', 'Заказ #' . $order->id)
@section('content')
  <div class="w-100">
    <div class="box px-4 py-4">
      <table class="table">
        <tbody>
          @foreach($order->orderItems as $orderItem)
            <tr>
              <td>
                <strong>{{ $orderItem->product->name }}</strong> <span class="text-muted">{{ number_format($orderItem->price) }} руб.</span>
                <ul>
                  @foreach($orderItem->addons as $addon)
                  <li>+ {{ $addon->name }} <span class="text-muted">{{ number_format($addon->pivot->price, 0, ',', ' ') }} руб.</span></li>
                  @endforeach
                </ul>
              </td>
              <td style="text-align: right;">{{ number_format($orderItem->price + $orderItem->addons->sum('pivot.price'), 0, ',', ' ') }} руб.</td>
              <td style="text-align: right;">
                {{ $orderItem->quantity }} шт.
              </td>
              <td style="text-align: right;">{{ number_format(($orderItem->price + $orderItem->addons->sum('pivot.price')) * $orderItem->quantity, 0, ',', ' ') }} руб.</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection