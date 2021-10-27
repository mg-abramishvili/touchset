@if($parent->parent)
    @include('products.sub ',['parent' => $parent->parent])
@endif
<a href="{{ route('category_item', ['id' => $parent->id]) }}">{{ $parent->name }}</a>&nbsp;→&nbsp;