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
        <div>
            <user-block :items="friends"></user-block>
        </div>
    </pages-layout>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3'
    import PagesLayout from '@/Layouts/PagesLayout'
    import UserBlock from '@/Components/UserBlock'
    export default {
        props: ['friends', 'requests'],
        components: {
            Head,
            PagesLayout,
            UserBlock
        }
    }
</script>

<style lang="css" scoped>
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>