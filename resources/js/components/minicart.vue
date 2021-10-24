<template>
    <div>
        Корзина ({{ value }})
    </div>
</template>

<script>
    export default {
        data() {
            return {
                value: '',
            };
        },
        mounted() {
            this.$root.$on('add_to_cart', data => {
                this.value = data
            });
        }
    }
</script>