<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div>{{ message }}</div>
</template>

<script>
export default {
    name: "TheCreateTodoListComponent",
    data() {
        return {
            message: 'testing'
        }
    }
}
</script>

<style scoped>

</style>
