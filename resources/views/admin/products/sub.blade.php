@if($parent->parent)
    @include('admin.products.sub ',['parent' => $parent->parent])
@endif
<span class="text-muted">{{ $parent->name }} → </span>