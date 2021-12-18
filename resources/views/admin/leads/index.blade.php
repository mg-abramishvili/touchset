@extends('layouts.admin')
@section('title', 'Заявки')
@section('content')
<div class="w-100">
    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <td>Дата</td>
                    <td>Контактное лицо</td>
                    <td>Телефон</td>
                    <td>E-mail</td>
                    <td>Сообщение</td>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->locale('ru')->isoFormat('DD.MM.YYYY')}}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->tel }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection