<template>
    <Head title="DevFriends - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                        DevFriends
                    </span>
                </div>
            </div>
        </template>
        <user-block :items="friends"></user-block>
    </pages-layout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3"
import PagesLayout from "@/Layouts/PagesLayout"
import InfiniteScroll from "@/Components/InfiniteScroll"
import UserBlock from "@/Components/UserBlock"
export default {
    props: ["friends", "requests"],
    components: {
        Head,
        PagesLayout,
        InfiniteScroll,
        UserBlock,
    }
};
</script>

<style lang="css" scoped>
.customSpan {
    background-color: #74b49b;
    font-weight: bold;
}
</style>
