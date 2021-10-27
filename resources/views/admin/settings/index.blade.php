@extends('layouts.admin')
@section('title', 'Настройки')
@section('content')
<div class="w-100">
    <form action="{{ route('admin_settings_update', ['id' => $settings->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$settings->id}}">

        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input type="text" name="tel" value="{{ $settings->tel }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="text" name="email" value="{{ $settings->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Адрес</label>
            <input type="text" name="address" value="{{ $settings->address }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">График работы</label>
            <input type="text" name="schedule" value="{{ $settings->schedule }}" class="form-control">
        </div>

        <input type="submit" class="btn btn-primary" value="Сохранить"/>

    </form>

</div>
@endsection