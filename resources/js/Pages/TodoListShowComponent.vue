<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="My Todo Lists"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Todo Lists
            </h2>
        </template>
        <div>

        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    name: "TodoListShowComponent",
    props: ['list'],
    data() {
        return {
        }
    },
    computed: {
    },
    methods: {
    }
}
</script>

<style scoped>
</style>
