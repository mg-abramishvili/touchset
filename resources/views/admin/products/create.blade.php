@extends('layouts.admin')
@section('title', 'Новый товар')
@section('content')
<div class="w-100">
    <form action="{{ route('admin_products_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <label class="form-label">Наименование</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Категория</label>
                    <select name="category" class="form-select">
                        <option disabled selected value>Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Цена</label>
                    <input type="text" name="price" class="form-control">
                </div>

                <div class="mb-3">
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

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
        });
    </script>
@endsection