<template>
<Head title="Membership Factura - DevTea" />
    <pages-layout>
        <template #title>
            <div
                class="flex flex-col items-center sm:flex-row sm:justify-between"
            >
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white bg-gradient-to-r from-regal-blue to-orange-600  leading-[3.5rem] px-2">
                    Membresía
                    </span>
                </div>
            </div>
            <div class="flex py-9">
                <h2>Pago realizado</h2>
                
            </div>
        </template>
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
    props: {
       
    },
    data() {
        return {};
    },

    methods: {
       
    },
};
</script>


