<template>
    <div>
        <a v-if="added_to_cart" href="/cart" class="btn btn-outline-standard">В корзине</a>
        <button v-else @click="addToCart()" class="btn btn-standard">В корзину</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['product_id'],
        data() {
            return {
                added_to_cart: false,
            };
        },
        mounted() {
            //console.log('Component mounted.')
        },
        methods: {
            addToCart() {
                axios
                .get(`/add-to-cart/${this.product_id}`)
                .then((response => {
                    this.added_to_cart = true
                    this.$root.$emit('update_cart', '1')
                }));
            }
        },
    }
</script>