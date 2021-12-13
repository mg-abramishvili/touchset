@extends('layouts.admin')
@section('title', 'Категории')
@section('add_button', route('admin_categories_create'))
@section('content')
<div class="w-100">
    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <td>Название</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    @if(isset($category->parent_id))
                    
                    @else
                        <tr>
                            <td>
                                <span style="font-weight: 700;">{{$category->name}}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin_category_edit', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
                            </td>
                        </tr>
                        @if(count($category->children))
                            @include('admin.categories.sub ', ['children' => $category->children])
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection