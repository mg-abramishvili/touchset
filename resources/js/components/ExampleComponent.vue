<template>
    <div>
        <button @click="test()" class="btn btn-primary ml-4"> Follow Me </button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            test() {
                this.$root.$emit('eventing', '555')
            }
        },
    }
</script>