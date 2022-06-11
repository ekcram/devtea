<template>
<Head title="Proyectos - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-col">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2 py-1">
                    Proyectos
                    </span>
                </div>
                <div class="flex mt-5 items-center justify-between">
                    <!-- Barra de búsqueda -->
                    <div class="flex items-center mr-4 mb-5 w-full max-w-md">
                    <div class="flex w-full bg-white rounded shadow">
                        <input 
                        v-model="params.search"
                        type="search" placeholder="Busca un proyecto..."
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
                                    Subir proyecto
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
                                        <form class="space-y-6" @submit.prevent="crearProyecto" enctype="multipart/form-data" method="POST">
                                            <div>
                                                <label for="Nombre" class="block mb-2 text-sm font-medium text-gray-900">
                                                    Nombre del proyecto
                                                </label>
                                                <input
                                                    type="text"
                                                    v-model="form.name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                                    block w-full p-2.5"
                                                    required
                                                />
                                            </div>
                                            <div>
                                                <label for="Descripción" class="block mb-2 text-sm font-medium text-gray-900">
                                                    Descripción
                                                </label>
                                                <textarea
                                                    v-model="form.description"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                                    block w-full p-2.5"
                                                    required></textarea>
                                            </div>
                                            <div>
                                                <input type="file" name="file_path" @input="form.file_path = $event.target.files[0]" 
                                                @change="previewFile"
                                                ref="file"
                                                accept="application/zip, image/jpeg, image/png, application/pdf, application/octet-stream"/>
                                            </div>
                                            <green-button
                                                type="submit"
                                                class="w-20 mx-60 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                                                text-sm px-5 py-2.5 text-center">Subir
                                            </green-button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </jet-dialog-modal>
                    </orange-button>
                </div>
                <!-- Bloque de proyectos -->
                <div v-for="(project, index) in projects.data" :key="index" class="relative block p-8 mb-5 overflow-hidden border border-gray-100 rounded-lg">
                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-green-500 to-green-600"></span>

                    <div class="justify-between sm:flex">
                    <div>
                        <h5 class="text-xl font-bold text-gray-900">
                         {{project.name}}
                        </h5>
                        <p class="mt-1 text-xs font-medium text-gray-600">Subido por: <span class="font-bold text-steel-teal">{{project.user.username}}</span></p>
                    </div>

                    <div class="flex-shrink-0 hidden ml-3 sm:block">
                        <img
                            :src="project.user.profile_photo_url"
                            alt="User Avatar"
                            class="object-cover w-16 h-16 rounded-lg shadow-sm"
                        />
                    </div>
                    </div>

                    <div class="mt-4 sm:pr-8">
                        <p class="text-sm text-gray-500">
                        {{project.description}}
                        </p>
                    </div>

                    <dl class="flex mt-6">
                        <div class="flex flex-col-reverse">
                            <dt class="text-sm font-medium text-gray-600 font-bold">Creación: {{project.created_at}}</dt>
                        </div>
                    </dl>
                    <div class="flex justify-end mt-5">
                        <a :href="route('projects.download', project.id)" class="inline-flex items-center bg-steel-teal hover:bg-midnight-green justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-white tracking-widest focus:outline-none transition ease-in-out duration-150">Descargar  <icon name="download" class="w-4 h-4 fill-current ml-2"></icon> </a>
                    </div>
                </div>
                <!-- Paginación -->
                <div v-if="projects.data.length === 0">
                    <p class="px-6 py-4 border-t" colspan="4">No se han encontrado resultados.</p>
                </div>

                <pagination class="mt-6" :links="projects.links" />
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
        filters: Object,
        projects: Object
    },
    data() {
        return {
            openModal: false,
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                name: this.name,
                description: this.description,
                file_path: null,
            }),
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        };
    },
    methods: {
        crearProyecto(){
            if (this.$refs.file) {
                this.form.file_path = this.$refs.file.files[0];
            }
            this.form.post(this.route('projects.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Projecto subido correctamente.",
                    })
                },
            })
            this.openModal = false
            this.form.name = null
            this.form.description = null
            this.form.file_path = null
        },
        reset(){
            this.filters.search = null
            this.$inertia.get(this.route('projects.index'))
        },
    },
    watch: {
            params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
        
                this.$inertia.get(this.route('projects.index'), params, { replace: true, preserveState: true });
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
