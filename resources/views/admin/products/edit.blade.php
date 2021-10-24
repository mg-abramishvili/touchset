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