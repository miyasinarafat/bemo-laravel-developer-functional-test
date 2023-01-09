<script setup>
import Authenticated from '@/Layouts/AuthenticatedLayout.vue';
import BoardNameForm from '@/Pages/Boards/BoardNameForm.vue';
import CardListCreateForm from '@/Pages/Boards/CardListCreateForm.vue';
import CardList from "@/Pages/Boards/CardList.vue";
import CardListItemModal from "@/Pages/Boards/CardListItemModal.vue";
import {ArrowCircleDownIcon} from '@heroicons/vue/solid';
import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps({
    board: Object,
    card: Object
});
</script>
<template>
    <Authenticated>
        <div class="flex flex-col h-full bg-blue-600 relative">
            <div class="shrink-0 flex flex-wrap justify-between items-center p-4">
                <BoardNameForm :board="board"/>
            </div>

            <div class="flex-1 overflow-x-auto">
                <div class="inline-flex h-full items-start px-4 pb-4 space-x-4">
                    <CardList
                        v-for="list in board.lists"
                        :key="list.id"
                        :list="list"
                        class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md"
                    >
                    </CardList>

                    <div class="w-72">
                        <CardListCreateForm :board="board"/>
                    </div>
                </div>
            </div>

            <div class="shrink-0 flex flex-wrap justify-between items-center p-4">
                <a
                  href="/sql-download"
                  class="p-4 w-32 h-14 absolute right-5 bottom-5 flex items-center justify-center bg-white/10 hover:bg-white/20 px-3 py-2 font-medium text-sm text-white rounded-md"
                >
                    <ArrowCircleDownIcon class="w-5 h-5"/>
                    <span class="ml-1">Export DB</span>
                </a>
            </div>
        </div>

        <CardListItemModal :card="props.card"/>
    </Authenticated>
</template>
