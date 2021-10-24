<template>
    <div>
        Корзина ({{ cart_amount }})
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                cart_amount: '',
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