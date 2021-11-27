<template>
    <div class="cart-page">

        <div v-if="completed == false" class="checkout-fields">
            {{cart}}
            <button @click="saveOrder()">Оформить заказ</button>
        </div>
        

        <div v-if="completed">
            <p>Заказ принят!</p>
            <p>Номер заказа: {{ completed_order_number }}</p>
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

                completed: false,
                completed_order_number: '',
            };
        },
        methods: {
            getCartInfo() {
                axios
                .get('/cart_data')
                .then((response => {
                    this.cart = response.data

                    // общее количество товаров в корзине
                    this.cart_products_total_quantity = []
                    for (let value of Object.values(response.data)) {
                        this.cart_products_total_quantity.push(parseInt(value['quantity']))
                    }
                    this.cart_products_total_quantity = this.cart_products_total_quantity.reduce((a, b) => a + b, 0)

                    // общее количество допов (услуг) в корзине
                    this.cart_addons_total_quantity = []
                    for (let value of Object.values(response.data)) {
                        this.cart_addons_total_quantity.push(parseInt(value['addons_array'].length))
                    }
                    this.cart_addons_total_quantity = this.cart_addons_total_quantity.reduce((a, b) => a + b, 0)

                    // итоговая цена корзины
                    this.cart_total_price = []
                    for (let value of Object.values(response.data)) {
                        this.cart_total_price.push(parseInt(value['price_total']))
                    }
                    this.cart_total_price = this.cart_total_price.reduce((a, b) => a + b, 0)
                }));
            },
            saveOrder() {
                var cartItemsArray = []
                for (var cartItem of Object.values(this.cart)) {
                    cartItemsArray.push({
                        "id": cartItem.id,
                        "price": cartItem.base_price,
                        "addons_array": cartItem.addons_array
                    })
                }

                axios
                .post(`/order-store`, { order_items: cartItemsArray })
                .then(response => (
                    this.completed = true,
                    this.completed_order_number = response.data
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            console.log(key)
                            alert(key)
                        }
                    }
                });
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