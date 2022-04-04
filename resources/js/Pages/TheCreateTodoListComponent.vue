<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import TodoItemComponent from "@/Pages/Todo/TodoItemComponent";
</script>

<template>
    <Head title="Create Todo List">
    </Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Todo List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="w-full">
                            <form class="w-full max-w-lg">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3 font-bold text-lg uppercase text-gray-700 mb-2">
                                        <h1>Todo List Info</h1>
                                    </div>
                                    <div class="w-full px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="list-title">
                                            Title
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="list-title"
                                            type="text"
                                            v-model="list.title"
                                        >
                                    </div>
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="list-description">
                                            Description
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="list-description"
                                            type="text"
                                            v-model="list.description"
                                        >
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3 font-bold text-lg uppercase text-gray-700 mb-2 flex">
                                        <h1 class="">Todo Items</h1>
                                        <a href="javascript:void(0);">
                                            <i @click="addTodoItem" class="fa fa-solid fa-plus text-green-600"></i>
                                        </a>
                                    </div>
                                    <todo-item-component
                                        v-for="item in todoItems"
                                        :key="item.key"
                                        :item="item"
                                        @itemChanged="updateItem"
                                    >
                                    </todo-item-component>
                                </div>
                                <div class="w-full mt-4">
                                    <a
                                        @click="submit"
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                        Create
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            list: {
                title: null,
                description: null
            },
            items: {},
            storeResponseData: null,
            todoItems: []
        }
    },
    computed: {
      todoCount(){
          return this.todoItems.length;
      }
    },
    methods: {
        submit: async function () {
            let payload = {
                title: this.list.title,
                description: this.list.description,
                items: this.todoItems
            }
            axios.post("/todo-list/store", payload)
                .then(response => {
                    this.storeResponseData = response.data.data
                })
        },
        addTodoItem() {
            this.todoItems.push({key: this.todoCount, title: '', description: ''})
        },
        updateItem(data){
            console.log(data)
            this.todoItems[data.key] = data;
        },
    },
}
</script>

<style scoped>
form input[type="text"] {
    border-color: #fff;
}
</style>
