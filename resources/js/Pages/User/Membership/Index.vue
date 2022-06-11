<template>
<Head title="Membership - DevTea" />
    <pages-layout>
        <template #title>
            <div
                class="flex flex-col items-center sm:flex-row sm:justify-between"
            >
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                    Membresía
                    </span>
                </div>
            </div>
            <div class="flex flex-row py-9">
                <div class="shadow-lg rounded-2xl w-screen h-83 bg-white p-4">
                    <p
                        class="text-regal-blue font-semibold text-3xl font-medium mb-4"
                    >
                        DevTea Premium
                    </p>
                    <p class="text-gray-900 dark:text-white text-3xl font-bold">
                        5€
                        <span class="text-gray-300 text-sm"> / mes </span>
                    </p>
                    <p class="text-gray-600 dark:text-gray-100 text-sm mt-4">
                        Membresía premium para que puedas acceder a contenido
                        exclusivo de los desarrolladores, ¡entre otras
                        cosas!<span>😀</span>
                    </p>
                    <ul
                        class="text-sm text-gray-600 dark:text-gray-100 w-full mt-6 mb-6"
                    >
                        <li class="mb-3 flex items-center">
                            <svg
                                class="h-6 w-6 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                width="6"
                                height="6"
                                stroke="currentColor"
                                fill="#10b981"
                                viewBox="0 0 1792 1792"
                            >
                                <path
                                    d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
                                ></path>
                            </svg>
                            Mensajes directos con los desarrolladores
                        </li>
                        <li class="mb-6 flex items-center">
                            <svg
                                class="h-6 w-6 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                width="6"
                                height="6"
                                stroke="currentColor"
                                fill="#10b981"
                                viewBox="0 0 1792 1792"
                            >
                                <path
                                    d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
                                ></path>
                            </svg>
                            Acceso a los productos que requieren de membresía
                        </li>
                    </ul>
                    <div class="mt-9">
                        <template v-if="subscriptionStatus !== 'active'">
                            <green-button :href="route('subscription.checkout')" class="w-full">
                                Escoger plan
                            </green-button>
                        </template>
                        <template v-else>
                            <green-button class="w-full" disabled style="cursor:not-allowed; background-color: #A7D7C5;">
                                Subscrito
                            </green-button>
                        </template>
                    </div>
                   
                </div>
                <div>
                    <img
                        :src="'/storage/images/foto-membresia.png'"
                        alt="Membresía"
                        class="w-screen"
                    />
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout.vue";
import GreenButton from "@/Components/Buttons/GreenButton.vue";
export default {
    components: {
        Head,
        PagesLayout,
        GreenButton
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
        subscription: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            subscriptionStatus: this.$page.props.subscription.status
        };
    },

    methods: {
    
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


