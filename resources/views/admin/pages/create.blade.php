@extends('layouts.admin')
@section('title', 'Новая страница')
@section('content')
<div class="w-100">
    <form action="{{ route('admin_pages_store') }}" method="post" enctype="multipart/form-data">
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
            <textarea id="content" name="content" class="form-control"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector('#content'), {
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