@extends('layouts.admin')
@section('title', 'Атрибуты')
@section('add_button', route('admin_attributes_create'))
@section('content')
<div class="w-100">
    <table class="table">
        <thead>
            <tr>
                <td>Название</td>
                <td>Код</td>
                <td>Сортровка</td>
                <td>Исп.</td>
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
                    <td>
                        {{ $attribute->order }}
                    </td>
                    <td>
                        @if($attribute->products->count() > 0)
                            {{ $attribute->products->count() }}
                        @endif
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