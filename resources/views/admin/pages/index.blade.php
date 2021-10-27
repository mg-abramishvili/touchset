@extends('layouts.admin')
@section('title', 'Страницы')
@section('content')
<div class="w-100">
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h1 class="m-0">Страницы</h1>
        </div>
        <!--<div class="col-12 col-md-6 text-end">
            <a href="{{ route('admin_pages_create') }}" class="btn btn-primary">Добавить</a>
        </div>-->
    </div>
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