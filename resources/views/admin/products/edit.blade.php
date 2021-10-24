@extends('layouts.admin')
@section('title', $product->name)
@section('content')
<div class="w-100">
    <h1>{{ $product->name }}</h1>

    <form action="{{ route('admin_product_edit', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$product->id}}">

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select name="category" class="form-select">
                <option disabled selected value>Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @foreach($product->categories as $pc) @if($pc->id == $category->id) selected @endif @endforeach>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Цена</label>
            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
        </div>

        <div class="mb-3">
            <textarea id="description" name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <hr>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input name="is_new" class="form-check-input" type="checkbox" id="is_new" value="1" {{ $product->is_new == true ? 'checked' : '' }}>
                <label class="form-check-label" for="is_new">Новинка</label>
            </div>

            <div class="form-check form-check-inline">
                <input name="is_popular" class="form-check-input" type="checkbox" id="is_popular" value="1" {{ $product->is_popular == true ? 'checked' : '' }}>
                <label class="form-check-label" for="is_popular">Популярное</label>
            </div>

            <div class="form-check form-check-inline">
                <input name="is_onsale" class="form-check-input" type="checkbox" id="is_onsale" value="1" {{ $product->is_onsale == true ? 'checked' : '' }}>
                <label class="form-check-label" for="is_onsale">Лучшая цена</label>
            </div>
        </div>
        <hr>
        
        <div class="my-4">
            @foreach($attributes as $attribute)
                <div class="row mb-2">
                    <div class="col-12 col-md-6">
                        {{ $attribute->name }}
                    </div>
                    <div class="col-12 col-md-6">
                        <input name="attribute[{{ $attribute->id }}]" type="text" class="form-control" @foreach($product->attributes as $p_attr) @if($attribute->id == $p_attr->id) value="{{ $p_attr->pivot->value }}" @endif @endforeach>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector('#description'), {
                toolbar: [ 'bold', 'italic', 'numberedList', 'bulletedList', 'insertTable' ]
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection