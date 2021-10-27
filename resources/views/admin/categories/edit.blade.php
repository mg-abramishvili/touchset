@extends('layouts.admin')
@section('title', $category->name)
@section('content')
<div class="w-100">
    <form action="{{ route('admin_category_update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$category->id}}">

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Код</label>
            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Родительская категория</label>
            <select name="parent_id" class="form-select">
                <option value="">Выберите категорию</option>
                @foreach($categories as $cat)
                    @if($cat->id != $category->id)
                        <option value="{{ $cat->id }}" @if($cat->id == $category->parent_id) selected @endif>{{ $cat->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-6">
                <input type="submit" class="btn btn-primary" value="Сохранить"/>
            </div>
            <div class="col-6 text-end">
                @if($category->products->count() > 0)
                    <button class="btn btn-outline-danger" disabled>Удалить</button>
                    <p class="text-muted"><small>В категории {{ $category->products->count() }} товаров</small></p>
                @else
                    <a href="{{ route('admin_category_delete', ['id' => $category->id]) }}" class="btn btn-outline-danger">Удалить</a>
                @endif
            </div>
        </div>

    </form>

</div>
@endsection