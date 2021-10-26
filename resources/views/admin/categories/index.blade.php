@extends('layouts.admin')
@section('title', 'Атрибуты')
@section('content')
<div class="w-100">
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h1 class="m-0">Категории</h1>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{ route('admin_categories_create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>Название</td>
                <td>Код</td>
                <td>Товаров</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        @if($category->parent)
                            <span class="text-muted">{{ $category->parent->name }} → </span>
                        @endif
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->slug }}
                    </td>
                    <td>
                        @if($category->products->count() > 0)
                            {{ $category->products->count() }}
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin_category_edit', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection