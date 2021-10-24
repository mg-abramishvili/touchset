@extends('layouts.admin')
@section('title', 'Новый товар')
@section('content')
<div class="w-100">
    <h1>Новый товар</h1>

    <form action="{{ route('admin_products_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select name="category" class="form-select">
                <option disabled selected value>Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Цена</label>
            <input type="text" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <textarea id="description" name="description" class="form-control"></textarea>
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