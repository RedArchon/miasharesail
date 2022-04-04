<template>
    <div class="mx-auto mt-8 place-content-center w-1/2 rounded shadow-lg px-4 py-4">
        <div class="grid grid-cols-3 grid-flow-col gap-2 font-bold">
            <div class="text-center">
                Title
            </div>

            <div class="text-center">
                Description
            </div>

            <div class="text-center">
                Status
            </div>
            <div class="text-center">
                Action
            </div>
        </div>
        <div class="grid grid-cols-3 grid-flow-col gap-2">
            <div>
                {{ item.title }}
            </div>

            <div>
                {{ item.description }}
            </div>

            <div>
                <div class="flex justify-center">
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                            type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            v-model="status"
                            :checked="status"
                            @change="toggleItemStatus"
                        >
                    </div>
                </div>
            </div>
            <a href="javascript:void(0);">
                <i @click="deleteItem" class="fa fa-solid text-red-600 fa-trash hover:text-red-500"></i>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoItemShowComponent",
    props: ['item'],
    data() {
        return {
            status: null
        }
    },
    computed: {},
    methods: {
        async deleteItem() {
            await axios.post(`/todo-item/${this.item.id}/destroy`)
                .then(() => {
                    this.$emit('itemDeleted', this.item);
                })
        },
        async toggleItemStatus() {
            await axios.put(`/todo-item/${this.item.id}/update`, {
                is_done: this.status
            })
        }
    },
    mounted() {
        this.status = this.item.is_done
    }
}
</script>

<style scoped>
</style>
