<template>
    <div>
        <div class="box px-4 py-4 mb-4">
            <div class="box-tab-content">
                <div class=" mb-4">
                    <label class="form-label">Наименование</label>
                    <input v-model="name" type="text" class="form-control">
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Символьный код</label>
                        <input v-model="slug" type="text" class="form-control">
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="form-label">Сортировка</label>
                        <input v-model="order" type="number" class="form-control">
                    </div>
                </div>
            </div>

            <button :disabled="saveAttribute_button == false"  @click="saveAttribute()" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                name: '',
                slug: '',
                order: '',

                saveAttribute_button: false,
            };
        },
        created() {
            setTimeout(() => {
                this.saveAttribute_button = true
            }, 1000)
        },
        methods: {
            saveAttribute() {
                if(this.name && this.name.length > 0 && this.slug && this.slug.length > 0 && this.order && this.order > 0) {
                    this.saveAttribute_button = false

                    axios
                    .post(`/_admin/attributes`, { name: this.name, slug: this.slug, order: this.order })
                    .then(response => (
                        window.location.href = '/admin/attributes'
                    ))
                    .catch((error) => {
                        if(error.response) {
                            this.updateAttribute_button = true
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
