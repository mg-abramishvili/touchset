<template>
    <div>
        <div v-if="parseInt(cart_amount) > 0">
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '1'">
                {{ cart_amount }} товар
            </template>
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '2' || cart_amount.toString().slice(-1) === '3' || cart_amount.toString().slice(-1) === '4'">
                {{ cart_amount }} товара
            </template>
            <template v-if="cart_amount && cart_amount.toString().slice(-1) === '5' || cart_amount.toString().slice(-1) === '6' || cart_amount.toString().slice(-1) === '7' || cart_amount.toString().slice(-1) === '8' || cart_amount.toString().slice(-1) === '9' || cart_amount.toString().slice(-1) === '0'">
                {{ cart_amount }} товаров
            </template>
            на {{ cart_price }} ₽
        </div>
        <div v-else>Корзина пуста</div>
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
                    //this.cart = response.data
                    var count = 0;
                    for (var k in response.data) {
                        if (response.data.hasOwnProperty(k)) count++;
                    }
                    this.cart_amount = count

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