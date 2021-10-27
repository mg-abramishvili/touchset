<ul class="pages-table-sub">
@foreach($children as $cat)
    <li>
        <span>
        {{ $cat->name }}
        @if(!$cat->children->count())
        <a href="{{ route('admin_category_edit', ['id' => $cat->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
        @else
        <a href="{{ route('admin_category_edit', ['id' => $cat->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
        @endif
        </span>
        @if(count($cat->children))
            @include('admin.categories.sub ',['children' => $cat->children])
        @endif
    </li>
@endforeach
</ul>