@extends('layouts.admin')
@section('title', 'Товары')
@section('add_button', route('admin_products_create'))
@section('content')
<div class="w-100">
    <div class="box">
        {{-- <a href="/admin/products-update-prices">Обновить цены</a> --}}
        <table class="table">
            <thead>
                <tr>
                    <td>Наименование</td>
                    <td>Категория</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <!--<td style="width: 60px;">
                            @if($product->gallery)
                                @foreach($product->gallery as $pg)
                                    @if($loop->first)
                                        <img src="{{ $pg }}" style="width: 60px;"/>
                                    @endif
                                @endforeach  
                            @endif
                        </td>-->
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            @foreach($product->categories as $category)
                                @if($category->parent)
                                    @include('admin.products.sub ', ['parent' => $category->parent])
                                    <br/>
                                @endif
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin_product_edit', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection