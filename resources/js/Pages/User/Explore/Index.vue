<template>
    <Head title="Explorar - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                        Explorar
                    </span>
                </div>
                <span
                    class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0"
                >
                    <!-- <inertia-link>
                        <button
                         :href="route('friends.index')"
                            class="bg-transparent hover:bg-green-400 text-indigo-700 font-semibold hover:text-white py-2 px-4 border border-indigo-500 hover:border-transparent rounded"
                        >
                            Ver mis amigos
                        </button>
                    </inertia-link> -->
                </span>
            </div>
        </template>
        <infinite-scroll @cargarMasItems="cargarMasMiembros">
             <user-block :items="allMembers.data"></user-block>
        </infinite-scroll>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout"
import UserBlock from "@/Components/UserBlock"
import InfiniteScroll from '@/Components/InfiniteScroll'
import axios from 'axios'
export default {
    props: ["members"],
    components: {
        Head,
        PagesLayout,
        UserBlock,
        InfiniteScroll,
    },
    data() {
        return {
            allMembers: this.members
        };
    },
    methods:{
        cargarMasMiembros(){
            if(!this.allMembers.next_page_url){
                return
            } 
            return  axios.get(this.allMembers.next_page_url).then(resp => {
                this.allMembers = {
                       ...resp.data,
                       data: [
                           ...this.allMembers.data, ...resp.data.data
                       ]
                }
            })
        }
    },
};
</script>

<style lang="css" scoped>
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>
