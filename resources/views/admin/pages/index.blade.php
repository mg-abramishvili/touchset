@extends('layouts.admin')
@section('title', 'Страницы')
@section('add_button', route('admin_pages_create'))
@section('content')
<div class="w-100">
    <table class="table">
        <thead>
            <tr>
                <td>Название</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>
                        {{ $page->name }}
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin_page_edit', ['id' => $page->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection