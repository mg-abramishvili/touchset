@extends('layouts.admin')
@section('title', 'Товары')
@section('content')
<div class="w-100">
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h1 class="m-0">Товары</h1>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{ route('admin_products_create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td></td>
                <td>Наименование</td>
                <td>Категория</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td style="width: 60px;">
                        @if($product->gallery)
                            @foreach($product->gallery as $pg)
                                @if($loop->first)
                                    <img src="{{ $pg }}" style="width: 60px;"/>
                                @endif
                            @endforeach  
                        @endif
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        @foreach($product->categories as $category)
                            @if($category->parent)
                                {{ $category->parent->name }} → 
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
@endsection