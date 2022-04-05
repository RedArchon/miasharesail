<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import TodoListCardComponent from "@/Pages/Todo/TodoListCardComponent";
</script>

<template>
    <Head title="My Todo Lists"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Todo Lists
            </h2>
        </template>

        <div class="flex flex-wrap m-4">
            <todo-list-card-component
                v-if="lists"
                v-for="list in lists"
                :list="list"
                :key="list.id"
            />
            <div v-else>You have no lists</div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    props: ['lists'],
    data() {
        return {
            values: null
        }
    },
    computed: {},
    methods: {},
    created() {
        this.values = this.lists;
    }
}
</script>

<style scoped>
</style>
