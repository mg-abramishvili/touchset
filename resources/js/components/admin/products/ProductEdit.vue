<template>
    <div>
        <ul class="box-tabs">
            <li @click="selectTab('general')" :class="{ 'active' : current_tab == 'general'}">Общая информация</li>
            <li @click="selectTab('attributes')" :class="{ 'active' : current_tab == 'attributes'}">Характеристики</li>
            <li @click="selectTab('gallery')" :class="{ 'active' : current_tab == 'gallery'}">Галерея</li>
            <li @click="selectTab('tags')" :class="{ 'active' : current_tab == 'tags'}">Метки</li>
            <li @click="selectTab('addons')" :class="{ 'active' : current_tab == 'addons'}">Допы</li>
            <li @click="selectTab('seo')" :class="{ 'active' : current_tab == 'seo'}">SEO</li>
        </ul>
        <div class="box px-4 py-4 mb-4">
            <div v-show="current_tab == 'general'" class="box-tab-content">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Наименование</label>
                        <input v-model="name" type="text" class="form-control">
                        <span class="text-muted"><small>https://touchset.ru/product/{{ slug }}</small></span>
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Категория</label>
                        <select v-model="category" class="form-select">
                            <option v-for="cat in categories" :key="'cat_' + cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Цена USD</label>
                        <input v-model="pre_usd" type="text" class="form-control">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Цена RUB</label>
                        <input v-model="pre_rub" type="text" class="form-control">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Курс USD <small>(на {{moment(usdKursDate).format('DD.MM.YYYY')}})</small></label>
                        <input v-model="usdKurs" type="text" class="form-control" disabled>
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Цена итоговая</label>
                        <input v-model="price" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Описание</label>
                    <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
                </div>
            </div>
            
            <div v-show="current_tab == 'attributes'" class="box-tab-content">
                <div v-for="attribute in attributes" :key="'attribute_' + attribute.id" class="row mb-4">
                    <div class="col-12 col-lg-6">
                        <label :for="'attribute_' + attribute.id" class="form-label">{{ attribute.name }}</label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input :id="'attribute_' + attribute.id" class="form-control">
                    </div>
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
                <div class="form-check form-switch mb-4">
                    <input v-model="is_new" class="form-check-input" id="is_new" type="checkbox">
                    <label class="form-check-label" for="is_new">Показывать в блоке <strong>Новые разработки</strong></label>
                </div>
                <div class="form-check form-switch mb-4">
                    <input v-model="is_popular" class="form-check-input" id="is_popular" type="checkbox">
                    <label class="form-check-label" for="is_popular">Показывать в блоке <strong>Популярные решения для киосков</strong></label>
                </div>
                <div class="form-check form-switch mb-4">
                    <input v-model="is_onsale" class="form-check-input" id="is_onsale" type="checkbox">
                    <label class="form-check-label" for="is_onsale">Показывать в блоке <strong>Специальное предложение</strong></label>
                </div>
            </div>

            <div v-show="current_tab == 'addons'" class="box-tab-content">
                <div v-for="addon in addons" :key="'addon_' + addon.id" class="mb-4">
                    <label :for="'addon_' + addon.id" class="form-label">{{ addon.name }}</label>
                    <input :id="'addon_' + addon.id" class="form-control">
                </div>
            </div>

            <div v-show="current_tab == 'seo'" class="box-tab-content">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-6"><label class="form-label">Title</label></div>
                        <div class="col-6 text-end"><span class="text-muted">{{ meta_title.length }} из 60</span></div>
                    </div>
                    <input v-model="meta_title" type="text" class="form-control">
                </div>
                <div class="mb-4">
                    <div class="row">
                        <div class="col-6"><label class="form-label">Meta Description</label></div>
                        <div class="col-6 text-end"><span class="text-muted">{{ meta_description.length }} из 160</span></div>
                    </div>
                    <input v-model="meta_description" type="text" class="form-control">
                </div>
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
                slug: '',
                pre_rub: '',
                pre_usd: '',
                description: '',
                meta_title: '',
                meta_description: '',
                is_new: '',
                is_popular: '',
                is_onsale: '',
                category: '',
                gallery: [],
                attribute: [],

                usdKurs: '',
                usdKursDate: '',

                categories: [],
                attributes: [],
                addons: [],

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

                moment: moment,
            };
        },
        created() {
            this.getUsdKurs()
            this.getProductInfo()
            this.getCategories()
            this.getAttributes()
            this.getAddons()
        },
        computed: {
            price: function () {
                if(this.pre_rub && this.pre_rub.length > 0 || this.pre_usd && this.pre_usd.length > 0) {
                    if(this.pre_rub && this.pre_rub.length > 0 && this.pre_usd && this.pre_usd.length > 0) {
                        return Math.ceil((parseFloat(this.pre_rub) + (parseFloat(this.usdKurs) * parseFloat(this.pre_usd))) / 50) * 50
                    } else if (!this.pre_rub) {
                        return Math.ceil(parseFloat(parseFloat(this.usdKurs) * parseFloat(this.pre_usd) / 50)) * 50
                    } else if (!this.pre_usd) {
                        return Math.ceil(parseFloat(this.pre_rub) / 50) * 50
                    }
                } else {
                    return 0
                }
            }
        },
        methods: {
            getUsdKurs() {
                axios
                .get('https://www.cbr-xml-daily.ru/daily_json.js', { withCredentials: false })
                .then(response => (
                    this.usdKurs = response.data.Valute.USD.Value.toFixed(2),
                    this.usdKursDate = response.data.Date
                ));
            },
            getProductInfo() {
                axios
                .get(`/_admin/product/${this.product_id}`)
                .then((response => {
                    this.product = response.data
                    this.name = response.data.name
                    this.slug = response.data.slug
                    this.pre_rub = response.data.pre_rub
                    this.pre_usd = response.data.pre_usd
                    this.category = response.data.categories[0].id

                    if(response.data.description && response.data.description.length > 0) {
                        this.description = response.data.description
                    }
                    if(response.data.meta_title && response.data.meta_title.length > 0) {
                        this.meta_title = response.data.meta_title
                    }
                    if(response.data.meta_description && response.data.meta_description.length > 0) {
                        this.meta_description = response.data.meta_description
                    }

                    if(response.data.is_new == 1) { this.is_new = true } else { this.is_new = false }
                    if(response.data.is_popular == 1) { this.is_popular = true } else { this.is_popular = false }
                    if(response.data.is_onsale == 1) { this.is_onsale = true } else { this.is_onsale = false }

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
            getAddons() {
                axios
                .get(`/_admin/addons`)
                .then((response => {
                    this.addons = response.data
                    setTimeout(() => {
                        this.getProductAddons()
                        this.updateProduct_button = true
                    }, 1000)
                }));
            },
            getProductAddons() {
                if(this.product && this.product.addons && this.product.addons.length > 0) {
                    this.product.addons.forEach((addn) => {
                        if(document.getElementById('addon_' + addn.id)) {
                            document.getElementById('addon_' + addn.id).value = addn.pivot.price
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
                    .put(`/_admin/product/${id}`, { id: id, name: this.name, price: this.price, description: this.description, meta_title: this.meta_title, meta_description: this.meta_description, is_new: this.is_new, is_popular: this.is_popular, is_onsale: this.is_onsale, category: this.category, attribute: this.attribute, gallery: this.gallery })
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
