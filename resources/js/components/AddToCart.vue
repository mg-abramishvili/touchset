<template>
    <div>
        <button @click="addToCart()" class="btn btn-standard">В корзину</button>
    </div>
</template>

<script>
    export default {
        props: ['product_id'],
        mounted() {
            //console.log('Component mounted.')
        },
        methods: {
            addToCart() {
                this.$root.$emit('add_to_cart', this.product_id)
            }
        },
    }
</script>