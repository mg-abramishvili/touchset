@extends('layouts.admin')
@section('title', $attribute->name)
@section('content')
<div class="w-100">
    <h1>{{ $attribute->name }}</h1>

    <form action="{{ route('admin_attribute_edit', ['id' => $attribute->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$attribute->id}}">

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" value="{{ $attribute->name }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Код</label>
            <input type="text" name="slug" value="{{ $attribute->slug }}" class="form-control">
        </div>

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection