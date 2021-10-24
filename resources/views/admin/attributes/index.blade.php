@extends('layouts.admin')
@section('title', 'Атрибуты')
@section('content')
<div class="w-100">
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h1 class="m-0">Атрибуты</h1>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{ route('admin_attributes_create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>Название</td>
                <td>Код</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>
                        {{ $attribute->name }}
                    </td>
                    <td>
                        {{ $attribute->slug }}
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin_attribute_edit', ['id' => $attribute->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection