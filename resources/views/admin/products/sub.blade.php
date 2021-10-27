@if($parent->parent)
    @include('admin.products.sub ',['parent' => $parent->parent])
@endif
<small>
    <span class="text-muted">{{ $parent->name }} → </span>
</small>