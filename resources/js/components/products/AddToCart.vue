<template>
    <div v-if="product_id && cart">
        <a v-if="added_to_cart || cart.includes(product_id)" href="/cart" class="btn btn-outline-standard">В корзине</a>
        <button v-else @click="addToCart()" class="btn btn-standard">В корзину</button>
        <button class="btn btn-outline-standard">Хочу демо-версию</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['product_id', 'addons'],
        data() {
            return {
                added_to_cart: false,
                checked_addons: [],

                cart: '',
            };
        },
        mounted() {
            this.$root.$on('addons', data => {
                this.getCheckedAddons(data)
            });
            this.$root.$on('data-to-product-page', data => {
                this.cart = []
                for (let value of Object.values(data)) {
                    this.cart.push(parseInt(value['id']))
                }
            });
        },
        methods: {
            getCheckedAddons(addons) {
                this.checked_addons = addons
            },
            addToCart() {
                axios
                .post(`/add-to-cart/${this.product_id}`, {addons: this.checked_addons})
                .then((response => {
                    this.added_to_cart = true
                    this.$root.$emit('update_cart', '1')
                    console.log(response.data)
                }));
            }
        },
    }
</script>