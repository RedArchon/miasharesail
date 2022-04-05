<template>
    <div @click="redirectToListPage"
         class="custom-card-width rounded overflow-hidden shadow-lg custom-progress-indicator border-t-4 border-solid mx-4 hover:bg-white cursor-pointer">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ list.title }}</div>
            <div class="w-full flex">
                <div class="w-full flex text-gray-700">
                    <span class="font-bold">Completed Items:</span>
                    <p class="ml-3">
                        <span class="progress-color font-bold">{{ itemsCompletedCount }}</span> of &nbsp;
                    </p>
                    <p class="font-bold">{{ itemsCount }}</p>
                </div>
            </div>
            <div class="w-full flex text-gray-700">
                <span class="text-gray-700">Created {{ list.ago }}</span>
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
            description: null,
            items: null
        }
    },
    computed: {
        itemsCount() {
            let count = this.items.filter(function(item){
                return !item.deleted_at
            })
            return count.length
        },
        itemsCompletedCount() {
            let items = this.items;

            return items.filter(this.filterCompletedItems).length
        },
        progressColor(){
            let progress = this.itemsCompletedCount / this.itemsCount;
            let progressColor = '';

            if (progress <= .25) {
                progressColor = '#f20a0a'
            } else if (progress <= .5) {
                progressColor = '#ff7d00'
            } else if (progress <= .75) {
                progressColor = '#0558ff'
            } else {
                progressColor = '#039c12'
            }

            return progressColor;
        }
    },
    methods: {
        filterCompletedItems(item) {
            if (item.is_done == true && !item.deleted_at) {
                return item;
            }
        },
        redirectToListPage() {
            window.location.href = `/todo-list/${this.list.id}`
        },
    },
    created() {
        this.items = this.list.items;
    }
}
</script>

<style scoped>
form input[type="text"] {
    border-color: #fff;
}

.custom-progress-indicator{
    border-color: v-bind(progressColor);
}

.progress-color{
    color: v-bind(progressColor);
}

.custom-card-width{
    width: 35rem;
}
</style>
