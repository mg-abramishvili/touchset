<template>
    <a href="/cart">
        <div class="header-bottom-cart-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            </svg>
        </div>
        <span>
            <strong>В корзине</strong>
            <small v-if="parseInt(cart_amount) > 0"><i>{{ cart_amount }} {{ cart_amount | dgt_products }}</i>, {{ cart_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }} ₽</small>
            <small v-else>Нет товаров</small>
        </span>
    </a>   
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                cart: '',
                cart_amount: '',
                cart_price: '',
            };
        },
        methods: {
            getCartInfo() {
                this.cart_amount = []
                for (let value of Object.values(this.cart)) {
                    this.cart_amount.push(parseInt(value['quantity']))
                }
                this.cart_amount = this.cart_amount.reduce((a, b) => a + b, 0)

                this.cart_price = []
                for (let value of Object.values(this.cart)) {
                    this.cart_price.push(parseInt(value['price_total']))
                }
                this.cart_price = this.cart_price.reduce((a, b) => a + b, 0)
            },
        },
        mounted() {
            axios
            .get('/cart_data')
            .then((response => {
                this.cart = response.data
                this.getCartInfo()
                this.$root.$emit('data-to-product-page', this.cart)
            }));

            this.$root.$on('update_cart', data => {
                axios
                .get('/cart_data')
                .then((response => {
                    this.cart = response.data
                    this.getCartInfo()
                }));
            });

            this.$root.$on('cart_data', data => {
                this.cart = data
                this.getCartInfo()
            });
        },
        filters: {
            dgt_products: function (x) {
                if (!x) return ''
                var forms = 'товар,товара,товаров'.split(',')
                var x10 = x % 10, x100 = x % 100, form = 2 // товаров

                if (x10 == 1 && x100 != 11)
                    form = 0 // товар
                else if (x10 > 1 && x10 < 5 && (x100 < 10 || x100 > 21))
                    form = 1 // товара

                return forms[form]
            },
        }
    }
</script>