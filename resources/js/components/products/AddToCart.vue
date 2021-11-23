<template>
    <div>
        <a v-if="added_to_cart" href="/cart" class="btn btn-outline-standard">В корзине</a>
        <button v-else @click="addToCart()" class="btn btn-standard">В корзину</button>
        <button class="btn btn-outline-standard">Хочу демо-версию</button>

{{checked_addons}}
        <ul>
            <li v-for="addon in addons" :key="'addon_' + addon.id">
                <span @click="checkAddon(addon.id)">
                    {{ addon.name }} {{ addon.products[0].pivot.price }}
                </span>
            </li>
        </ul>
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
            };
        },
        mounted() {
            //console.log('Component mounted.')
        },
        methods: {
            checkAddon(id) {
                this.checked_addons.push(id)
            },
            addToCart() {
                axios
                .post(`/add-to-cart/${this.product_id}`, {addons: this.checked_addons})
                .then((response => {
                    this.added_to_cart = true
                    this.$root.$emit('update_cart', '1')
                }));
            }
        },
    }
</script>