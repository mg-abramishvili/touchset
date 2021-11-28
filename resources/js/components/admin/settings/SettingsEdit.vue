<template>
  <div class="box px-4 py-4">
      <div class="mb-3">
          <label class="form-label">Телефон</label>
          <input v-model="tel" type="text" class="form-control">
      </div>
      <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input v-model="email" type="text" class="form-control">
      </div>
      <div class="mb-3">
          <label class="form-label">Адрес</label>
          <input v-model="address" type="text" class="form-control">
      </div>
      <div class="mb-3">
          <label class="form-label">График работы</label>
          <input v-model="schedule" type="text" class="form-control">
      </div>

      <button  @click="updateSettings()" class="btn btn-primary">Сохранить</button>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                tel: '',
                email: '',
                address: '',
                schedule: '',
            };
        },
        created() {
          this.getSettingsInfo()
        },
        methods: {
          getSettingsInfo() {
                axios
                .get(`/_admin/settings`)
                .then((response => {
                    this.tel = response.data.tel
                    this.email = response.data.email
                    this.address = response.data.address
                    this.schedule = response.data.schedule
                }));
            },
            updateSettings() {
                if(this.tel && this.tel.length > 0) {
                    axios
                    .put('/_admin/setting/1', { id: 1, tel: this.tel, email: this.email, address: this.address, schedule: this.schedule })
                    .then(response => (
                        window.location.href = '/admin/settings'
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
