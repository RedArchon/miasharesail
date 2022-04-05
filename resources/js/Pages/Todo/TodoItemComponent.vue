<template>
    <div class="flex px-3">
        {{itemOrder}}
        <div class="w-full px-3 mb-6 md:mb-0">
            <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="item-title">
                Title
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="item-title"
                type="text"
                v-model="title"
                @change="$emit('itemChanged', values)"
            >
        </div>
        <div class="w-full px-3">
            <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="item-description">
                Description
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="item-description"
                type="text"
                v-model="description"
                @change="$emit('itemChanged', values)"
            >
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoItemComponent",
    props: ['item'],
    data(){
        return {
            title: null,
            description: null
        }
    },
    computed: {
        values(){
            return {
                key: this.item.key,
                title: this.item.title,
                description: this.item.description
            }
        },
        itemOrder(){
            return this.item.key + 1;
        }
    }
}
</script>

<style scoped>
form input[type="text"] {
    border-color: #fff;
}
</style>
