<template>
    <div class="page-individual">
        <h5 class="block-title">Доп. услуги</h5>
        <div v-for="addon in addons" :key="'addon_' + addon.id" class="form-check">
            <input class="form-check-input" type="checkbox" value="" :id="'addon_' + addon.id">
            <label @click="checkAddon(addon.id)" class="form-check-label" :for="'addon_' + addon.id">
                {{ addon.name }} <small>{{ addon.products[0].pivot.price }} ₽</small>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['addons'],
        data() {
            return {
                checked_addons: [],
            };
        },
        mounted() {
            //console.log('Component mounted.')
        },
        methods: {
            checkAddon(id) {
                if(this.checked_addons.includes(id)) {
                    this.checked_addons.splice(this.checked_addons.indexOf(id), 1)
                    this.checked_addons.sort()
                } else {
                    this.checked_addons.push(id)
                    this.checked_addons.sort()
                }

                this.$root.$emit('addons', this.checked_addons)
            },
        },
    }
</script>