<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import TodoItemShowComponent from "@/Pages/Todo/TodoItemShowComponent";</script>

<template>
    <Head title="My Todo Listsss"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    List: {{ list.title }}
                </h2>
                <h2></h2>
            </div>

        </template>
        <div class="lg:overflow-y-scroll" style="height: 35rem;">
            <todo-item-show-component
                v-if="todo"
                v-for="item in todo.items"
                :key="item.id"
                :item="item"
                :is_admin="is_admin"
                @itemDeleted="removeItemFromList"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    name: "TodoListShowComponent",
    props: ['list', 'is_admin'],
    data() {
        return {
            todo: {},
        }
    },
    methods: {
        removeItemFromList(itemToDelete) {
            if(!this.is_admin){
                this.todo.items = this.todo.items.filter(function (item){
                    return item.id !== itemToDelete.id
                });
            }
        },
    },
    mounted() {
        this.todo = {...this.list, items:[...this.list.items]}
    }

}
</script>

<style scoped>
</style>
