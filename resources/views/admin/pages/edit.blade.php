@extends('layouts.admin')
@section('title', $page->name)
@section('content')
<div class="w-100">
    <h1>{{ $page->name }}</h1>

    <form action="{{ route('admin_page_edit', ['id' => $page->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$page->id}}">

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" value="{{ $page->name }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Код</label>
            <input type="text" name="slug" value="{{ $page->slug }}" class="form-control">
        </div>

        <div class="mb-3">
            <textarea id="content" name="content" class="form-control">{{ $page->content }}</textarea>
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