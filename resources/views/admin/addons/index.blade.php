@extends('layouts.admin')
@section('title', 'Допы')
@section('add_button', route('admin_addons_create'))
@section('content')
<div class="w-100">
    <div class="box">
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
                @foreach($addons as $addon)
                    <tr>
                        <td>
                            {{ $addon->name }}
                        </td>
                        <td>
                            {{ $addon->slug }}
                        </td>
                        <td>
                            {{ $addon->order }}
                        </td>
                        <td>
                            @if($addon->products->count() > 0)
                                {{ $addon->products->count() }}
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin_addon_edit', ['id' => $addon->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection