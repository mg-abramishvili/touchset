@foreach($children as $cat)
    <tr>
        <td>
            ↪ {{ $cat->name }}
        </td>
        <td class="text-end">
            <a href="{{ route('admin_category_edit', ['id' => $cat->id]) }}" class="btn btn-sm btn-outline-primary">Правка</a>
        </td>
    </tr>
    @if(count($cat->children))
        @include('admin.categories.sub ',['children' => $cat->children])
    @endif
@endforeach