<template>
    <div class="cart-page">
        {{cart}}
        <div class="row">
            <div class="col-12 col-lg-8">
                <div v-for="cartItem in cart" :key="'cartItem_' + cartItem.id" class="cart-item">
                    <div class="row align-items-center">
                        <div class="col cart-item-col-name">
                            <a :href="'/product/' + cartItem.id" style="text-decoration: none; color: #333;">{{ cartItem.name }}</a>
                            <ul>
                                <li v-for="addon in cartItem.addons" :key="'addon_' + addon.id">{{ addon.name }} ({{ addon.products[0].pivot.price }})</li>
                            </ul>
                        </div>
                        <div class="col cart-item-col-quantity">
                            <button @click="updateQuantityMinus(cartItem.id)" class="btn btn-sm">-</button>
                            <input @change="updateQuantity(cartItem.id)" type="number" :id="'quantity_' + cartItem.id" :value="cartItem.quantity" min="1" class="form-control w-25 d-inline-flex cart-item-amount">
                            <button @click="updateQuantityPlus(cartItem.id)" class="btn btn-sm">+</button>
                        </div>
                        <div class="col cart-item-col-price">
                            <strong>{{ cartItem.price_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }}</strong> ₽
                        </div>
                        <div class="col cart-item-col-del">
                            <button @click="remove(cartItem.id)" class="btn btn-sm btn-outline-danger">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-panel">
                    <h5>В корзине</h5>
                    <p>{{ cart_amount }}</p>
                    <button class="btn btn-standard">Перейти к оформлению</button>
                </div>
            </div>
        </div>
        
    </div>
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
                axios
                .get('/cart_data')
                .then((response => {
                    this.cart = response.data

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
            updateQuantity(id) {
                var quantity = parseInt(document.getElementById('quantity_' + id).value)
                axios
                .get(`/update-cart/${id}/${quantity}`)
                .then(response => (
                    this.getCartInfo(),
                    this.$root.$emit('update_cart', '1')
                ));
            },
            updateQuantityMinus(id) {
                var quantity = parseInt(document.getElementById('quantity_' + id).value)
                if(quantity !== 0) {
                    axios
                    .get(`/update-cart/${id}/${quantity - 1}`)
                    .then(response => (
                        this.getCartInfo(),
                        this.$root.$emit('update_cart', '1')
                    ));
                }
            },
            updateQuantityPlus(id) {
                var quantity = parseInt(document.getElementById('quantity_' + id).value)
                axios
                .get(`/update-cart/${id}/${quantity + 1}`)
                .then(response => (
                    this.getCartInfo(),
                    this.$root.$emit('update_cart', '1')
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