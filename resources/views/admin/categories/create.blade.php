@extends('layouts.admin')
@section('title', 'Новый товар')
@section('content')
<div class="w-100">
    <h1>Новая категория</h1>

    <form action="{{ route('admin_categories_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Код</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Родительская категория</label>
            <select name="parent_id" class="form-select">
                @foreach($categories as $category)
                    <option value="" selected>Выберите категорию</option>
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection