<template>
    <div v-if="show" style="display: inline-block">
        <small v-if="parseInt(cart_products_total_quantity) > 0"><i>{{ cart_products_total_quantity }} {{ cart_products_total_quantity | dgt_products }}</i>, {{ cart_total_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }} ₽</small>
        <small v-else>Нет товаров</small>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                cart: '',
                cart_products_total_quantity: '',
                cart_total_price: '',

                show: false
            };
        },
        methods: {
            getCartInfo() {
                    // общая стоимость корзины
                    this.cart_total_price = []
                    for (let value of Object.values(this.cart)) {
                        var cartItem_product_price = parseInt(value.price)
                        var cartItem_quantity = parseInt(value.quantity)
                        if(value.addons_selected && value.addons_selected.length > 0) {
                            var cartItem_addons_price = value.addons_selected.map(x => parseInt(x.pivot.price)).reduce((a, b) => a + b, 0)
                        } else {
                            var cartItem_addons_price = 0
                        }
                        this.cart_total_price.push((cartItem_product_price + cartItem_addons_price) * cartItem_quantity)
                    }
                    this.cart_total_price = this.cart_total_price.reduce((a, b) => a + b, 0)

                    // общее количество товаров в корзине
                    this.cart_products_total_quantity = []
                    for (let value of Object.values(this.cart)) {
                        this.cart_products_total_quantity.push(parseInt(value['quantity']))
                    }
                    this.cart_products_total_quantity = this.cart_products_total_quantity.reduce((a, b) => a + b, 0)

                    this.show = true
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