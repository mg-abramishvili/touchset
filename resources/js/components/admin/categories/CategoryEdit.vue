<template>
    <div>
        <ul class="box-tabs">
            <li @click="selectTab('general')" :class="{ 'active' : current_tab == 'general'}">Общая информация</li>
            <li @click="selectTab('cover')" :class="{ 'active' : current_tab == 'cover'}">Обложка</li>
            <li @click="selectTab('seo')" :class="{ 'active' : current_tab == 'seo'}">SEO</li>
        </ul>
        <div class="box px-4 py-4 mb-4">
            <div v-show="current_tab == 'general'" class="box-tab-content">
                <div class="mb-4">
                    <label class="form-label">Наименование</label>
                    <input v-model="name" type="text" class="form-control">
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Символьный код</label>
                        <input v-model="slug" type="text" class="form-control">
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Вложить в категорию</label>
                        <select v-model="parent_id" class="form-select">
                            <option value="0">—</option>
                            <template v-for="cat in categories">
                                <option v-if="cat.id !== category.id" :value="cat.id">{{ cat.name }}</option>
                            </template>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <label class="form-label">Описание</label>
                        </div>
                        <div class="col-6 text-end">
                            <button v-if="description_show_code == false" @click="description_show_code_toggle()" class="btn btn-sm btn-outline-secondary" style="font-size: 10px;">посмотреть код</button>
                            <button v-if="description_show_code == true" @click="description_show_code_toggle()" class="btn btn-sm btn-outline-secondary" style="font-size: 10px;">визуальный редактор</button>
                        </div>
                    </div>
                    <ckeditor v-if="description_show_code == false" :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
                    <textarea v-if="description_show_code == true" v-model="description" class="form-control"></textarea>
                </div>
            </div>
            
            <div v-show="current_tab == 'cover'" class="box-tab-content">
                <file-pond
                    name="cover"
                    ref="cover"
                    label-idle="Выбрать картинку..."
                    v-bind:allow-multiple="false"
                    v-bind:allow-reorder="false"
                    accepted-file-types="image/jpeg, image/png"
                    :server="server"
                    v-bind:files="filepond_cover_edit"
                />
            </div>

            <div v-show="current_tab == 'seo'" class="box-tab-content">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-6"><label class="form-label">Title</label></div>
                        <div class="col-6 text-end">
                            <span class="text-muted">
                                <template v-if="meta_title.length > 60">
                                    <i class="text-danger" style="font-style: normal">{{ meta_title.length }}</i>
                                </template>
                                <template v-else>
                                    {{ meta_title.length }}
                                </template>
                                из 60
                            </span>
                        </div>
                    </div>
                    <input v-model="meta_title" type="text" class="form-control">
                    <span @click="seo_input_add()" class="seo_input_add">название товара</span>
                </div>
                <div class="mb-4">
                    <div class="row">
                        <div class="col-6"><label class="form-label">Meta Description</label></div>
                        <div class="col-6 text-end">
                            <span class="text-muted">
                                <template v-if="meta_description.length > 160">
                                    <i class="text-danger" style="font-style: normal">{{ meta_description.length }}</i>
                                </template>
                                <template v-else>
                                    {{ meta_description.length }}
                                </template>
                                из 160
                            </span>
                        </div>
                    </div>
                    <textarea v-model="meta_description" rows="2" class="form-control" style="resize: none"></textarea>
                </div>
            </div>

            <button :disabled="updateCategory_button == false"  @click="updateCategory(category.id)" class="btn btn-primary">Сохранить</button>
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
        props: ['category_id'],
        data() {
            return {
                category: {},
                name: '',
                slug: '',
                description: '',
                description_show_code: false,
                meta_title: '',
                meta_description: '',
                cover: '',
                parent_id: '',

                categories: [],

                filepond_cover: [],
                filepond_cover_edit: [],

                current_tab: 'general',

                updateCategory_button: false,

                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    toolbar: [ 'heading', 'bold', '|', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'undo', 'redo' ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Тег P' },
                            { model: 'heading2', view: 'h2', title: 'Тег H2' },
                            { model: 'heading3', view: 'h3', title: 'Тег H3' },
                            { model: 'heading4', view: 'h4', title: 'Тег H4' },
                            { model: 'heading5', view: 'h5', title: 'Тег H5' }
                        ]
                    }
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
                        request.open('POST', '/_admin/categories/file/upload');
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

                moment: moment,
            };
        },
        created() {
            this.getCategoryInfo()
            this.getCategories()
        },
        methods: {
            getCategoryInfo() {
                axios
                .get(`/_admin/category/${this.category_id}`)
                .then((response => {
                    this.category = response.data
                    this.name = response.data.name
                    this.slug = response.data.slug

                    if(response.data.parent_id && response.data.parent_id > 0) {
                        this.parent_id = response.data.parent_id
                    } else {
                        this.parent_id = 0
                    }
                    if(response.data.description && response.data.description.length > 0) {
                        this.description = response.data.description
                    }
                    if(response.data.meta_title && response.data.meta_title.length > 0) {
                        this.meta_title = response.data.meta_title
                    }
                    if(response.data.meta_description && response.data.meta_description.length > 0) {
                        this.meta_description = response.data.meta_description
                    }

                    if(response.data.cover) {
                        this.filepond_cover_edit = [
                            {
                                source: response.data.cover,
                                options: {
                                    type: 'local',
                                }
                            }
                        ]
                    }
                }));
            },
            getCategories() {
                axios
                .get(`/_admin/categories`)
                .then((response => {
                    this.categories = response.data
                    setTimeout(() => {
                        this.updateCategory_button = true
                    }, 1000)
                }));
            },
            selectTab(tab) {
                this.current_tab = tab
            },
            description_show_code_toggle() {
                if(this.description_show_code == true) {
                    this.description_show_code = false
                } else {
                    this.description_show_code = true
                }
            },
            seo_input_add() {
                this.meta_title = this.meta_title + this.name
            },
            updateCategory(id) {
                if(document.getElementsByName("cover")[0]) {
                    this.cover = document.getElementsByName("cover")[0].value
                }

                if(this.name && this.name.length > 0 && this.slug && this.slug.length > 0) {
                    this.updateCategory_button = false

                    axios
                    .put(`/_admin/category/${id}`, { id: id, name: this.name, slug: this.slug, parent_id: this.parent_id, description: this.description, meta_title: this.meta_title, meta_description: this.meta_description, cover: this.cover })
                    .then(response => (
                        window.location.href = '/admin/categories'
                    ))
                    .catch((error) => {
                        if(error.response) {
                            this.updateCategory_button = true
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