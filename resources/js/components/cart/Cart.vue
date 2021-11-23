<template>
    <div class="cart-page">
        <div v-if="loading" class="cart-page-overlay"></div>
        <div v-if="loading" class="spinner-border text-primary cart-page-overlay-spinner" role="status">
            <span class="sr-only"></span>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div v-for="cartItem in cart" :key="'cartItem_' + cartItem.sku" class="cart-item">
                    <div class="row align-items-center">
                        <div class="col cart-item-col-name">
                            <a :href="'/product/' + cartItem.id" style="text-decoration: none; color: #333;">{{ cartItem.name }}</a>
                            
                            <div v-for="addon in cartItem.addons_all" :key="'addon_' + addon.id" class="form-check">
                                <input @change="changeAddon(cartItem, addon)" v-if="cartItem.addons_array.includes(addon.id)" class="form-check-input" type="checkbox" value="" :id="'sku_addon_' + cartItem.sku + '_' + addon.id" checked>
                                <input @change="changeAddon(cartItem, addon)" v-else class="form-check-input" type="checkbox" value="" :id="'sku_addon_' + cartItem.sku + '_' + addon.id">
                                <label class="form-check-label" :for="'sku_addon_' + cartItem.sku + '_' + addon.id">
                                    {{addon.name}}, {{ addon.products[0].pivot.price }}
                                </label>
                            </div>

                        </div>
                        <div class="col cart-item-col-quantity">
                            <button @click="updateQuantityMinus(cartItem)" class="btn btn-sm">-</button>
                            <input @change="updateQuantity(cartItem)" type="number" :id="'quantity_' + cartItem.sku" :value="cartItem.quantity" min="1" class="form-control w-25 d-inline-flex cart-item-amount">
                            <button @click="updateQuantityPlus(cartItem)" class="btn btn-sm">+</button>
                        </div>
                        <div class="col cart-item-col-price">
                            <strong>{{ cartItem.price_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }}</strong> ₽
                        </div>
                        <div class="col cart-item-col-del">
                            <button @click="remove(cartItem.sku)" class="btn btn-sm btn-outline-danger">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-panel">
                    <h5>В корзине</h5>
                    <p>{{ cart_amount }}</p>
                    <p>{{ cart_price}}</p>
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

                loading: false,
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
            changeAddon(cartItem, addon) {
                if(cartItem.addons_array.includes(addon.id)) {
                    cartItem.addons_array.splice(cartItem.addons_array.indexOf(addon.id), 1)
                    cartItem.addons_array.sort()
                    cartItem.price = parseInt(cartItem.price) - parseInt(addon.products[0].pivot.price)
                    this.updateQuantity(cartItem)
                } else {
                    cartItem.addons_array.push(addon.id)
                    cartItem.addons_array.sort()
                    cartItem.price = parseInt(cartItem.price) + parseInt(addon.products[0].pivot.price)
                    this.updateQuantity(cartItem)
                }
            },
            updateCart() {
                this.loading = true
                axios
                .post(`/update-cart`, {cart: this.cart})
                .then((response => {
                    this.getCartInfo()
                    setTimeout(() => this.loading = false, 1000);
                }));
            },
            updateQuantity(cartItem) {
                var quantity = parseInt(document.getElementById('quantity_' + cartItem.sku).value)
                if(quantity !== 0) {
                    document.getElementById('quantity_' + cartItem.sku).value = quantity
                    cartItem.quantity = quantity
                    cartItem.price_total = cartItem.quantity * cartItem.price
                }
                this.$root.$emit('cart_data', this.cart)
                this.updateCart()
            },
            updateQuantityMinus(cartItem) {
                var quantity = parseInt(document.getElementById('quantity_' + cartItem.sku).value)
                if(quantity !== 0 && quantity !== 1) {
                    document.getElementById('quantity_' + cartItem.sku).value = quantity - 1
                    cartItem.quantity = quantity - 1
                    cartItem.price_total = cartItem.quantity * cartItem.price
                }
                this.$root.$emit('cart_data', this.cart)
                this.updateCart()
            },
            updateQuantityPlus(cartItem) {
                var quantity = parseInt(document.getElementById('quantity_' + cartItem.sku).value)
                document.getElementById('quantity_' + cartItem.sku).value = quantity + 1
                cartItem.quantity = quantity + 1
                cartItem.price_total = cartItem.quantity * cartItem.price
                this.$root.$emit('cart_data', this.cart)
                this.updateCart()
            },
            remove(sku) {
                axios
                .get(`/remove-from-cart/${sku}`)
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