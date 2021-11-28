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
                            
                            <div v-for="addon in cartItem.addons" :key="'addon_' + addon.id" class="form-check">
                                <input @change="changeAddon(cartItem, addon)" v-if="cartItem.addons_selected && cartItem.addons_selected.length > 0 && cartItem.addons_selected.map(x => x.id).includes(addon.id)" class="form-check-input" type="checkbox" value="" :id="'sku_addon_' + cartItem.sku + '_' + addon.id" checked>
                                <input @change="changeAddon(cartItem, addon)" v-else class="form-check-input" type="checkbox" value="" :id="'sku_addon_' + cartItem.sku + '_' + addon.id">
                                <label class="form-check-label" :for="'sku_addon_' + cartItem.sku + '_' + addon.id">
                                    {{addon.name}} <span style="color:#888;">{{ addon.pivot.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }} ₽</span>
                                </label>
                            </div>

                        </div>
                        <div class="col cart-item-col-quantity">
                            <button @click="updateQuantityMinus(cartItem)" class="btn btn-sm">-</button>
                            <input @change="updateQuantity(cartItem)" type="number" :id="'quantity_' + cartItem.sku" :value="cartItem.quantity" min="1" class="form-control w-25 d-inline-flex cart-item-amount">
                            <button @click="updateQuantityPlus(cartItem)" class="btn btn-sm">+</button>
                        </div>
                        <div class="col cart-item-col-price">
                            <template v-if="cartItem.addons_selected && cartItem.addons_selected.length > 0"><strong>{{ (parseInt(cartItem.price) + parseInt(cartItem.addons_selected.map(x => parseInt(x.pivot.price)).reduce((a, b) => a + b, 0))) * cartItem.quantity }}</strong> ₽</template>
                            <template v-else><strong>{{ (cartItem.price * cartItem.quantity) }}</strong> ₽</template>
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
                    <p>{{ cart_products_total_quantity }} {{ cart_products_total_quantity | dgt_products }}, {{ cart_addons_total_quantity }} {{ cart_addons_total_quantity | dgt_addons }}</p>
                    <h4>{{ cart_total_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }} ₽</h4>
                    <button @click="proceedToCheckout()" class="btn btn-standard">Перейти к оформлению</button>
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
                cart_products_total_quantity: '',
                cart_addons_total_quantity: '',
                cart_total_price: '',
                
                loading: false,
            };
        },
        methods: {
            getCartInfo() {
                axios
                .get('/cart_data')
                .then((response => {
                    this.cart = response.data

                    // общая стоимость корзины
                    this.cart_total_price = []
                    for (let value of Object.values(response.data)) {
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
                    for (let value of Object.values(response.data)) {
                        this.cart_products_total_quantity.push(parseInt(value['quantity']))
                    }
                    this.cart_products_total_quantity = this.cart_products_total_quantity.reduce((a, b) => a + b, 0)

                    // общее количество допов (услуг) в корзине
                    this.cart_addons_total_quantity = []
                    for (let value of Object.values(response.data)) {
                        if(value['addons_selected'] && value['addons_selected'].length > 0) {
                            this.cart_addons_total_quantity.push(parseInt(value['addons_selected'].length))
                        }
                    }
                    this.cart_addons_total_quantity = this.cart_addons_total_quantity.reduce((a, b) => a + b, 0)
                }));
            },
            changeAddon(cartItem, addon) {
                if(cartItem.addons_selected && cartItem.addons_selected.length > 0 && cartItem.addons_selected.map(x => x.id).includes(addon.id)) {
                    cartItem.addons_selected = cartItem.addons_selected.filter(item => item.id !== addon.id)
                } else {
                    if(cartItem.addons_selected && cartItem.addons_selected.length > 0) {
                        var new_array = []
                        cartItem.addons_selected.forEach((item) => {
                            new_array.push(item)
                        })
                        new_array.push(cartItem.addons.filter(item => item.id == addon.id)[0])
                        cartItem.addons_selected = new_array
                    } else {
                        cartItem.addons_selected = cartItem.addons.filter(item => item.id == addon.id)
                    }
                }

                this.updateQuantity(cartItem)
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
                }
                this.$root.$emit('cart_data', this.cart)
                this.updateCart()
            },
            updateQuantityMinus(cartItem) {
                var quantity = parseInt(document.getElementById('quantity_' + cartItem.sku).value)
                if(quantity !== 0 && quantity !== 1) {
                    document.getElementById('quantity_' + cartItem.sku).value = quantity - 1
                    cartItem.quantity = quantity - 1
                }
                this.$root.$emit('cart_data', this.cart)
                this.updateCart()
            },
            updateQuantityPlus(cartItem) {
                var quantity = parseInt(document.getElementById('quantity_' + cartItem.sku).value)
                document.getElementById('quantity_' + cartItem.sku).value = quantity + 1
                cartItem.quantity = quantity + 1
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
            },
            proceedToCheckout() {
                this.loading = true
                this.updateCart()
                window.location.href = '/checkout'
            },
        },
        mounted() {
            this.getCartInfo()
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
            dgt_addons: function (x) {
                if (!x) return ''
                var forms = 'услуга,услуги,услуг'.split(',')
                var x10 = x % 10, x100 = x % 100, form = 2 // услуг

                if (x10 == 1 && x100 != 11)
                    form = 0 // услуга
                else if (x10 > 1 && x10 < 5 && (x100 < 10 || x100 > 21))
                    form = 1 // услуги

                return forms[form]
            }
        },
    }
</script>