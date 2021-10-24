<template>
    <div class="minicart">
        <div v-if="parseInt(cart_amount) > 0" class="minicart-content">
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '1'">
                <strong>{{ cart_amount }}</strong>&nbsp;товар
            </template>
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '2' || cart_amount.toString().slice(-1) === '3' || cart_amount.toString().slice(-1) === '4'">
                <strong>{{ cart_amount }}</strong>&nbsp;товара
            </template>
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '5' || cart_amount.toString().slice(-1) === '6' || cart_amount.toString().slice(-1) === '7' || cart_amount.toString().slice(-1) === '8' || cart_amount.toString().slice(-1) === '9' || cart_amount.toString().slice(-1) === '0'">
                <strong>{{ cart_amount }}</strong>&nbsp;товаров
            </template>
            на&nbsp;<strong>{{ cart_price }}</strong>&nbsp;₽
        </div>
        <div v-else class="minicart-content">Корзина пуста</div>
        <div class="minicart-icon">
            <img src="/img/minicart.svg" />
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                cart_amount: '',
                cart_price: '',
            };
        },
        methods: {
            getCartInfo() {
                axios
                .get('/cart_data')
                .then((response => {
                    this.cart_amount = []
                    for (let value of Object.values(response.data)) {
                        this.cart_amount.push(parseInt(value['quantity']))
                    }
                    this.cart_amount = this.cart_amount.reduce((a, b) => a + b, 0)

                    this.cart_price = []
                    for (let value of Object.values(response.data)) {
                        this.cart_price.push(parseInt(value['price_total']))
                    }
                    this.cart_price = this.cart_price.reduce((a, b) => a + b, 0)
                }));
            },
        },
        mounted() {
            this.getCartInfo()
            /*this.$root.$on('add_to_cart', data => {
                this.value = data
            });*/
            this.$root.$on('update_cart', data => {
                this.getCartInfo()
            });
        }
    }
</script>