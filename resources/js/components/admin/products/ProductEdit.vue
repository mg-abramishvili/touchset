<template>
    <div>
        <ul class="box-tabs">
            <li @click="selectTab('general')" :class="{ 'active' : current_tab == 'general'}">Общая информация</li>
            <li @click="selectTab('attributes')" :class="{ 'active' : current_tab == 'attributes'}">Характеристики</li>
            <li @click="selectTab('gallery')" :class="{ 'active' : current_tab == 'gallery'}">Галерея</li>
            <li @click="selectTab('tags')" :class="{ 'active' : current_tab == 'tags'}">Метки</li>
            <li @click="selectTab('seo')" :class="{ 'active' : current_tab == 'seo'}">SEO</li>
        </ul>
        <div class="box px-4 py-4">
            <div v-show="current_tab == 'general'" class="box-tab-content">
                <div class="mb-3">
                    <label class="form-label">Наименование</label>
                    <input v-model="name" type="text" class="form-control">
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-8">
                        <label class="form-label">Категория</label>
                        <select v-model="category" class="form-select">
                            <option v-for="cat in categories" :key="'cat_' + cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="form-label">Цена</label>
                        <input v-model="price" type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
                </div>
            </div>
            
            <div v-show="current_tab == 'attributes'" class="box-tab-content">
                <div v-for="attribute in attributes" :key="'attribute_' + attribute.id" class="mb-3">
                    <label :for="'attribute_' + attribute.id" class="form-label">{{ attribute.name }}</label>
                    <input :id="'attribute_' + attribute.id" class="form-control">
                </div>
            </div>
            
            <div v-show="current_tab == 'gallery'" class="box-tab-content">
                <file-pond
                    name="gallery[]"
                    ref="gallery"
                    label-idle="Выбрать картинки..."
                    v-bind:allow-multiple="true"
                    v-bind:allow-reorder="true"
                    accepted-file-types="image/jpeg, image/png"
                    :server="server"
                    v-bind:files="filepond_gallery_edit"
                />
            </div>

            <div v-show="current_tab == 'tags'" class="box-tab-content">
                Теги
            </div>

            <div v-show="current_tab == 'seo'" class="box-tab-content">
                SEO
            </div>

            <button :disabled="updateProduct_button == false"  @click="updateProduct(product.id)" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    import vueFilePond from "vue-filepond";
    import "filepond/dist/filepond.min.css";
    import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
    import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
    import FilePondPluginImagePreview from "filepond-plugin-image-preview";
    const FilePond = vueFilePond(
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
    );

    export default {
        props: ['product_id'],
        data() {
            return {
                product: {},
                name: '',
                price: '',
                description: '',
                category: '',
                gallery: [],
                attribute: [],

                categories: [],
                attributes: [],

                filepond_gallery: [],
                filepond_gallery_edit: [],

                current_tab: 'general',

                updateProduct_button: false,

                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    toolbar: [ 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'undo', 'redo' ],
                    //table: {
                    //    toolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                    //},
                    //extraPlugins: [this.uploader],
                },

                server: {
                    remove(filename, load) {
                        load('1');
                    },
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        const request = new XMLHttpRequest();
                        request.open('POST', '/_admin/products/file/upload');
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
            };
        },
        created() {
            this.getProductInfo()
            this.getCategories()
            this.getAttributes()
        },
        methods: {
            getProductInfo() {
                axios
                .get(`/_admin/product/${this.product_id}`)
                .then((response => {
                    this.product = response.data
                    this.name = response.data.name
                    this.price = response.data.price
                    this.category = response.data.categories[0].id

                    if(response.data.description && response.data.description.length > 0) {
                        this.description = response.data.description
                    }

                    if(response.data.gallery) {
                        this.filepond_gallery_edit = response.data.gallery.map(function(element){
                            {
                                return {
                                    source: element,
                                    options: {
                                        type: 'local',
                                    }
                                } 
                            }
                        })
                    }
                }));
            },
            getCategories() {
                axios
                .get(`/_admin/categories`)
                .then((response => {
                    this.categories = response.data
                }));
            },
            getAttributes() {
                axios
                .get(`/_admin/attributes`)
                .then((response => {
                    this.attributes = response.data
                    setTimeout(() => {
                        this.getProductAttributes()
                        this.updateProduct_button = true
                    }, 1000)
                }));
            },
            getProductAttributes() {
                if(this.product && this.product.attributes && this.product.attributes.length > 0) {
                    this.product.attributes.forEach((attr) => {
                        if(document.getElementById('attribute_' + attr.id)) {
                            document.getElementById('attribute_' + attr.id).value = attr.pivot.value
                        }
                    })
                }
            },
            selectTab(tab) {
                this.current_tab = tab
            },
            updateProduct(id) {
                this.attribute = []
                this.attributes.forEach((attr) => {
                    var value_value = null

                    if(document.getElementById('attribute_' + attr.id) && document.getElementById('attribute_' + attr.id).value && document.getElementById('attribute_' + attr.id).value.length > 0) {
                        value_value = document.getElementById('attribute_' + attr.id).value
                    }

                    this.attribute.push({ id: attr.id, value: value_value })
                })
                
                if(document.getElementsByName("gallery[]")) {
                    this.gallery = []
                    document.getElementsByName("gallery[]").forEach((galleryItem) => {
                        if(galleryItem.value) {
                            this.gallery.push(galleryItem.value)
                        }
                    });
                }

                if(this.name && this.name.length > 0 && this.price && this.price > 0 && this.category && this.category > 0) {
                    this.updateProduct_button = false

                    axios
                    .put(`/_admin/product/${id}`, { id: id, name: this.name, price: this.price, description: this.description, category: this.category, attribute: this.attribute, gallery: this.gallery })
                    .then(response => (
                        //setTimeout(() => this.updateProduct_button = true, 1000),
                        window.location.href = '/admin/products'
                        //console.log(response.data)
                    ))
                    .catch((error) => {
                        if(error.response) {
                            this.updateProduct_button = true
                            for(var key in error.response.data.errors){
                                console.log(key)
                                alert(key)
                            }
                        }
                    });
                } else {
                    alert('Заполните поля')
                }
            },
        },
    }
</script>
