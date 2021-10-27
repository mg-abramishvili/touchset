@extends('layouts.admin')
@section('title', 'Категории')
@section('content')
<div class="w-100">
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h1 class="m-0">Категории</h1>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{ route('admin_categories_create') }}" class="btn btn-primary">Добавить</a>
        </div>
    </div>

    <ul class="tree">
        @forelse($categories as $category)
            @if(isset($category->parent_id))
            
            @else
                <li>
                    <span>
                    {{$category->name}}
                    @if(!$category->children->count())
                        <a href="{{ route('admin_category_edit', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    @else
                        <a href="{{ route('admin_category_edit', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                    @endif
                    </span>
                    @if(count($category->children))
                        @include('admin.categories.sub ', ['children' => $category->children])
                    @endif
                </li>
            @endif
        @empty
        <li>
            Пусто &#9785;
        </li>
        @endforelse
    </ul>

</div>
@endsection