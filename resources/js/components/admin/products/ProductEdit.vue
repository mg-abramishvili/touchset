<template>
    <div>
        <div class="row">
            <div class="col-12 col-md-9">
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
                <hr>
                <div class="mb-3">
                    галки
                </div>
                <hr>
                
                <div class="my-4">
                    <ul>
                        <li v-for="attribute in attributes" :key="'attribute_' + attribute.id">{{ attribute.name }}</li>
                    </ul>
                </div>
                <hr>

                <button @click="updateProduct(product.id)" class="btn btn-primary">Сохранить</button>
            </div>
            <div class="col-12 col-md-3">
                filepond
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: ['product_id'],
        data() {
            return {
                product: {},
                name: '',
                price: '',
                description: '',
                category: '',

                categories: [],
                attributes: [],

                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    toolbar: [ 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'undo', 'redo' ],
                    //table: {
                    //    toolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                    //},
                    //extraPlugins: [this.uploader],
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
                    this.description = response.data.description
                    this.category = response.data.categories[0].id
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
                }));
            }
        },
    }
</script>
