<template>
    <div>
        Cart ({{ value }})
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
            this.$root.$on('eventing', data => {
                this.value = data
            });
        }
    }
</script>