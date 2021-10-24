@extends('layouts.admin')
@section('title', 'Товары')
@section('content')
<div class="w-100">
    <table class="table">
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin_product_edit', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection