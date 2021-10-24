@extends('layouts.front')
@section('title', $page->name)
@section('content')
<div class="page-page">
    <div class="container mt-4">
        @if($page->slug == 'contacts')
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="block-title block-page-title">{{ $page->name }}</h1>
                    {!! $page->content !!}
                </div>
                <div class="col-12 col-md-6">
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Adeb9b7f69ae0ee99e14bbabe3e661e2f6152a6b66ea848218512ee70bbf06652&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
                </div>
            </div>
        @else
            <h1 class="block-title block-page-title">{{ $page->name }}</h1>
            {!! $page->content !!}
        @endif
    </div>
</div>
@endsection