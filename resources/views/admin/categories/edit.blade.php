@extends('layouts.admin')
@section('title', $category->name)
@section('content')
<div class="w-100">
    <category-edit :category_id="{{ $category->id }}"></category-edit>
</div>
@endsection