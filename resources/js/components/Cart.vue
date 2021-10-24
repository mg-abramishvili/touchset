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
                        <input type="number" :id="'quantity_' + cartItem.id" @change="updateQuantity(cartItem.id)" :value="cartItem.quantity" min="0" class="form-control w-25">
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
                console.log(id, quantity)
            },
            remove(id) {
                axios
                .get(`/remove-from-cart/${id}`)
                .then(response => (
                    this.getCartInfo()
                ));
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