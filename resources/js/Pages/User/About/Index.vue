<template>
    <Head title="Acerca de - DevTea" />
    <pages-layout>
        <a class="block p-8 bg-mint-cream shadow-xl rounded-xl" href="">
            <h3 class="text-center text-3xl">🎓</h3>
            <h3 class="mt-3 text-xl font-bold text-gray-700 text-center">Autor: Marco Martínez Arenas</h3>
            <h3 class="mt-3 text-xl font-bold text-gray-700 text-center">IES Trassierra</h3>
        </a>
    </pages-layout>
</template>

<script>
 import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout.vue";
export default {
    components: {
        Head,
        PagesLayout,
    },
};
</script>

<style lang="css" scoped>
    h6{
        color: #375D5F;
    }

    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>


