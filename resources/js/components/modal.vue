<template>
  <div class="modal" id="modal_1" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Оставить заявку</h5>
          <button @click="close_modal()" type="button" class="btn-close"></button>
        </div>
        <div class="modal-body">
          <div v-if="success">
            <p>Заявка успешно отправлена!</p>
          </div>
          <div v-else>
            <div class="mb-3">
              <label for="name" class="form-label">Контактное лицо</label>
              <input v-model="name" id="name" type="text" class="form-control" placeholder="Иван Петров">
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="tel" class="form-label">Телефон</label>
                  <input v-model="tel" id="tel" type="text" class="form-control" placeholder="+7 999 123-45-67">
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input v-model="email" id="email" type="text" class="form-control" placeholder="mail@mail.ru">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Сообщение (не обязательно)</label>
              <textarea v-model="message" id="message" type="text" class="form-control" placeholder="Иван Петров"></textarea>
            </div>
            <button @click="saveLead()" class="btn-standard">Отправить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
              name: '',
              tel: '',
              email: '',
              message: '',

              success: false
            };
        },
        methods: {
            close_modal() {
              this.name = ''
              this.tel = ''
              this.email = ''
              this.message = ''
              document.getElementById("modal_1").classList.remove("modal-show");
              document.getElementsByClassName("modal-backdrop")[0].classList.remove("backdrop-show");
            },
            saveLead() {
              axios
              .post(`/lead`, { name: this.name, tel: this.tel, email: this.email, message: this.message })
              .then((response => {
                  this.success = true
                  setTimeout(() => {
                    this.success = false
                    this.close_modal()
                  }, 2000)
              }))
              .catch((error) => {
                  if(error.response) {
                      for(var key in error.response.data.errors){
                          console.log(key)
                      }
                  }
              });
            }
        },
    }
</script>