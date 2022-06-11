<template>
    <Head title="DevTalk - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-col">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                    DevTalk
                    </span>
                </div>
                <div class="flex mt-5 items-center justify-between">
                     <!-- Barra de búsqueda -->
                    <div class="flex items-center mr-4 mb-5 w-full max-w-md">
                        <div class="flex w-full bg-white rounded shadow">
                            <input 
                            v-model="params.search"
                            type="search" placeholder="Busca un tema..."
                            class="relative px-6 py-3 w-full rounded focus:shadow-outline focus:border-green-500" 
                            />
                        </div>
                        <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="reset()">Limpiar</button>
                    </div>

                    <!-- Ventana modal -->
                    <orange-button @click="openModal = !openModal">
                        <icon name="plus" class="w-4 h-4 fill-current"></icon>
                        <jet-dialog-modal :show="openModal">
                            <template v-slot:title>
                                 <h3 class="font-normal text-xl text-orange-800 leading-normal">
                                    Crea un nuevo tema de discusión
                                </h3>
                                <button type="button" @click="openModal = false" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                                rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 
                                        1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </template>
                            <template v-slot:content>
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="py-6 px-6 lg:px-8">
                                        <form class="space-y-6" @submit.prevent="crearDiscusion">
                                            <div>
                                                <label for="Tema" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    ¿Cúal es tu tema?
                                                </label>
                                                <input
                                                    type="text"
                                                    v-model="form.name"
                                                    id="name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                                    block w-full p-2.5"
                                                    required
                                                />
                                            </div>
                                                <green-button
                                                type="submit"
                                                class="w-20 mx-60 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                                                text-sm px-5 py-2.5 text-center">Crear</green-button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </jet-dialog-modal>
                    </orange-button>
                </div>
                <!-- Bloque de temas -->
                <div class="bg-white border-2 border-gray-100 rounded-xl mt-5" v-for="(doubt, index) in doubts.data" :key="index" >
                    <div class="flex items-start p-6">
                        <a href="" class="block shrink-0">
                        <img
                            :src="doubt.user.profile_photo_url"
                            alt="User Avatar"
                            class="object-cover rounded-lg h-14 w-14"
                        />
                        </a>

                        <div class="ml-4">
                        <strong class="font-medium sm:text-lg text-midnight-green">
                            <a href="" class="hover:underline">
                          {{doubt.name}}</a
                            >
                        </strong>

                        <div class="mt-2 sm:flex sm:items-center sm:gap-2">
                            <p class="hidden sm:block sm:text-xs sm:text-gray-500">
                            Publicado por
                                <span class="font-medium hover:text-gray-700">{{doubt.user.name}} {{doubt.user.surname}}</span>
                            </p>
                        </div>
                        </div>
                    </div>

                     <div class="flex justify-start ml-5">
                        <green-button 
                        :href="route('doubts.show',{slug: doubt.slug})" 
                        class="mt-4 py-2 px-3 text-xs text-right text-white
                        rounded-lg hover:bg-regal-blue focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Ver
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 
                        011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </green-button>
                    </div>

                    <div class="flex justify-end">   
                        <span v-if="doubt.is_resolved === 1" class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 last:mr-0 mr-1">
                            Resuelto
                        </span>
                        <span v-else class="text-xs font-semibold inline-block py-1 px-2 rounded text-rose-600 bg-rose-200 last:mr-0 mr-1">
                            Sin resolver
                        </span>
                    </div>
                </div>
                <div v-if="doubts.data.length === 0">
                        <p class="px-6 py-4 border-t" colspan="4">No se han encontrado resultados.</p>
                    </div>
            
                <pagination class="mt-6" :links="doubts.links" />
            </div>

        </template>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout";
import GreenButton from "@/Components/Buttons/GreenButton";
import OrangeButton from "@/Components/Buttons/OrangeButton";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import Pagination from '@/Components/Pagination'
import { pickBy, throttle } from 'lodash';

export default {
    components: {
        Head,
        PagesLayout,
        GreenButton,
        OrangeButton,
        JetDialogModal,
        Pagination,
    },
    props: {
        doubts: Object,
        filters: Object,
    },
    data() {
        return {
            openModal: false,
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                name: null,
                is_resolved: 0,
            }),
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        };
    },
    methods: {
        crearDiscusion(){
            this.form.post(this.route('doubts.store_doubt'), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Duda registrada correctamente.",
                    })
                    this.form.name = null
                },
            })
            this.openModal = false
        },
        reset(){
            this.filters.search = null
            this.$inertia.get(this.route('doubts.index'))
        }
    },
     watch: {
            params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
        
                this.$inertia.get(this.route('doubts.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
            },
        },
};
</script>

<style lang="css" scoped>
    h6{
        color: #375D5F;
    }

     h3{
        color: #E94A47;
    }

    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }

    
</style>
