@extends('layouts.admin')
@section('title', 'Новый товар')
@section('content')
<div class="w-100">
    <h1>Новый товар</h1>

    <form action="{{ route('admin_attributes_store') }}" method="post" enctype="multipart/form-data">
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

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection