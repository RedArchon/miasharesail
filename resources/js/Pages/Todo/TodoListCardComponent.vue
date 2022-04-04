<template>
    <div @click="redirectToListPage" class="max-w-sm rounded overflow-hidden shadow-lg mx-4 hover:bg-white cursor-pointer">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ list.title }}</div>
            <div class="w-full flex">
                <div class="w-full flex text-gray-700">
                    <span class="font-bold">Completed Items:</span>
                    <p v-if="itemsCompletedCount > 0" class="ml-3">
                        <span class="text-green-600 font-bold">{{ itemsCompletedCount }}</span> of &nbsp;
                    </p>
                    <p v-else class="ml-3">
                        <span class="text-red-600 font-bold">{{ itemsCompletedCount }}</span> of &nbsp;
                    </p>
                    <p class="font-bold">{{ itemsCount }}</p>
                </div>
            </div>
            <div class="w-full flex text-gray-700">
                <span class="text-gray-700">Created {{list.ago}}</span>
            </div>
            <div class="w-full mt-4">
                <h2 class="font-bold text-gray-700 text-lg">Description</h2>
            </div>
            <p class="text-gray-700 text-base">
                {{ list.description }}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#personal</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#budget</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoListCardComponent",
    props: ['list'],
    data() {
        return {
            title: null,
            description: null
        }
    },
    computed: {
        itemsCount() {
            return this.list.items.length;
        },
        itemsCompletedCount() {
            let items = this.list.items;

            return items.filter(this.filterCompletedItems).length
        },
    },
    methods: {
        filterCompletedItems(item) {
            if (item.is_done == true) {
                return item;
            }
        },
        redirectToListPage(){
            window.location.href = `/todo-list/${this.list.id}`
        }
    }
}
</script>

<style scoped>
form input[type="text"] {
    border-color: #fff;
}
</style>
