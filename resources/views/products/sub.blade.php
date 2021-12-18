@if($parent->parent)
    @include('products.sub ',['parent' => $parent->parent])
@endif
<a href="{{ route('category_item', ['slug' => $parent->slug]) }}">{{ $parent->name }}</a>&nbsp;→&nbsp;