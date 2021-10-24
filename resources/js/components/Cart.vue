<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <td>Наименование</td>
                    <td>Цена</td>
                    <td>Количество</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cartItem in cart" :key="'cartItem_' + cartItem.id">
                    <td class="w-50">
                        {{ cartItem.name }}
                    </td>
                    <td>
                        {{ cartItem.price }} руб.
                    </td>
                    <td>
                        <input type="number" :id="'quantity_' + cartItem.id" :value="cartItem.quantity" min="0" class="form-control w-25 d-inline-flex">
                        <button @click="updateQuantity(cartItem.id)" class="btn btn-sm btn-outline-primary d-inline-flex">OK</button>
                    </td>
                    <td>
                        {{ cartItem.price_total }} руб.
                    </td>
                    <td>
                        <button @click="remove(cartItem.id)" class="btn btn-sm btn-outline-danger">&times;</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    
    export default {
        data() {
            return {
                cart: '',
            };
        },
        methods: {
            getCartInfo() {
                axios
                .get('/cart_data')
                .then(response => (
                    this.cart = response.data
                ));
            },
            updateQuantity(id) {
                var quantity = parseInt(document.getElementById('quantity_' + id).value)
                axios
                .get(`/update-cart/${id}/${quantity}`)
                .then(response => (
                    this.getCartInfo()
                ));
            },
            remove(id) {
                axios
                .get(`/remove-from-cart/${id}`)
                .then((response => {
                    this.getCartInfo()
                    this.$root.$emit('update_cart', '1')
                }));
            }
        },
        mounted() {
            /*this.$root.$on('add_to_cart', data => {
                this.cart = data
            });*/
            this.getCartInfo()
        }
    }
</script>