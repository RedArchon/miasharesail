<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import TodoItemShowComponent from "@/Pages/Todo/TodoItemShowComponent";
</script>

<template>
    <Head title="My Todo Lists"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    List: {{ list.title }}
                </h2>
                <h2>Item Count: {{list.items.length}}</h2>
            </div>

        </template>
        <div class="lg:overflow-y-scroll" style="height: 35rem;">
            <todo-item-show-component
                v-for="item in list.items"
                :key="item.id"
                :item="item"
                @itemDeleted="removeItemFromList"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    name: "TodoListShowComponent",
    props: ['list'],
    methods: {
        removeItemFromList(itemToDelete){
            this.list.items = this.list.items.filter(function(item){
                if(item.id !== itemToDelete.id){
                    return true;
                }
            })
        },
    },

}
</script>

<style scoped>
</style>
