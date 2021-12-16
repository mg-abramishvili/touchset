@extends('layouts.admin')
@section('title', $attribute->name)
@section('content')
<div id="app" class="w-100">
    <attribute-edit :attribute_id="{{ $attribute->id }}"></attribute-edit>
</div>
@endsection