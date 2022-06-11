<template>
    <Head title="Ayuda General - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-row py-9">
               <div class="p-8 bg-white border border-blue-100 shadow-lg rounded-2xl" role="alert">
                    <div class="items-center sm:flex">
                        <span class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-steel-teal rounded-full">
                        <svg class="w-4 h-4" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                            clip-rule="evenodd"
                            d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                            fill-rule="evenodd"
                            />
                        </svg>
                        </span>

                        <p class="mt-3 text-lg font-medium sm:mt-0 sm:ml-3">Ayuda general</p>
                    </div>

                    <p class="mt-4 text-gray-500">
                      Ante cualquier indicendia que se produzca en la aplicación, contacte con el administrador a través de la siguiente dirección de correo
                      electrónico: <br/><br/><strong>mrckeu03@gmail.com</strong>
                      <br/><br/>Gracias.
                    </p>

                <div class="mt-6 sm:flex">
                    <a
                    class="inline-block w-full px-5 py-3 text-sm font-semibold text-center text-white bg-steel-teal hover:bg-green-sheen rounded-lg sm:w-auto"
                    :href="route('dashboard.index')"
                    >
                    Ir a Inicio
                    </a>
                </div>
                </div>
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


