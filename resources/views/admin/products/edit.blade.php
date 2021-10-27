@extends('layouts.admin')
@section('title', $product->name)
@section('content')
<div class="w-100">
    <form action="{{ route('admin_product_edit', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$product->id}}">

        <div class="row">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <label class="form-label">Наименование</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Категория</label>
                    <select name="category" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @foreach($product->categories as $pc) @if($pc->id == $category->id) selected @endif @endforeach>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Цена</label>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                </div>

                <div class="mb-3">
                    <textarea id="description" name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input name="is_new" class="form-check-input" type="checkbox" id="is_new" value="1" {{ $product->is_new == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_new">Новинка</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input name="is_popular" class="form-check-input" type="checkbox" id="is_popular" value="1" {{ $product->is_popular == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_popular">Популярное</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input name="is_onsale" class="form-check-input" type="checkbox" id="is_onsale" value="1" {{ $product->is_onsale == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_onsale">Лучшая цена</label>
                    </div>
                </div>
                <hr>
                
                <div class="my-4">
                    @foreach($attributes as $attribute)
                        <div class="row mb-2">
                            <div class="col-12 col-md-6">
                                {{ $attribute->name }}
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="attribute[{{ $attribute->id }}]" type="text" class="form-control" @foreach($product->attributes as $p_attr) @if($attribute->id == $p_attr->id) value="{{ $p_attr->pivot->value }}" @endif @endforeach>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>

                <input type="submit" class="btn btn-primary" value="Сохранить"/>
            </div>
            <div class="col-12 col-md-3">
                <input class="gallery" type="file" name="gallery[]" multiple>
            </div>
        </div>

    </form>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector('#description'), {
                toolbar: [ 'bold', 'italic', 'numberedList', 'bulletedList', 'insertTable' ]
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const galleryFPond = document.querySelector('input[name="gallery[]"]');

        const pond = FilePond.create(galleryFPond, {
            //maxFiles: 10,
            //maxFileSize: '3MB',
            allowReorder: true,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',
        });

        FilePond.setOptions({
            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deleteimage');
                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/admin/products/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },
            files: [
                @if(isset($product->gallery))
                    @foreach($product->gallery as $image)
                    {
                        source: '{{ $image }}',
                        options: {
                            type: 'local',
                        }
                    },
                    @endforeach
                @endif
            ]
        });
    </script>
@endsection