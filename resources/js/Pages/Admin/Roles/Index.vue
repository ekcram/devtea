<template>
<Head title="Roles - DevTea" />
    <admin-layout>
        <div>
            <div class="flex flex-col items-center sm:flex-row justify-between">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter mb-5">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                        Roles
                    </span>
                </div>
                <!-- Ventana modal -->
                <div class="items-end mb-4">
                    <orange-button @click="openModal = !openModal" v-if="$page.props.auth.can.manageRoles">
                        <icon name="plus" class="w-4 h-4 fill-current"></icon>
                        <jet-dialog-modal :show="openModal">
                            <template v-slot:title>
                                 <h3 class="font-normal text-xl text-orange-800 leading-normal">
                                    Crea un nuevo rol
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
                                        <form class="space-y-6" @submit.prevent="crearRol">
                                            <div>
                                                <label for="Tema" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    Nombre del rol
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
            </div>
            
            <!-- Filtro de búsqueda -->
            <div class="flex items-center mr-4 mb-5 w-full max-w-md">
                    <div class="flex w-full bg-white rounded shadow">
                        <input 
                        v-model="params.search"
                        type="search" placeholder="Busca un rol..."
                        class="relative px-6 py-3 w-full rounded focus:shadow-outline focus:border-green-500" 
                        />
                    </div>
                    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="reset()">Limpiar</button>
            </div>

            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-steel-teal font-extrabold text-white rounded">
                    <tr>
                        <th class="p-4 text-center whitespace-nowrap">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('name')">Nombre
                            <svg v-if="params.field === 'name' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
    
                            <svg v-if="params.field === 'name' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Fecha creación
                        </div>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Fecha actualización
                        </div>
                        </th>
                        <th class="p-4 text-right whitespace-nowrap">
                        <div class="flex justify-center">
                            Acciones
                        </div>
                        </th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-100">
                <tr v-for="(role,index) in roles.data" :key="index">
                    <td class="p-4 font-medium text-gray-900 whitespace-nowrap">{{role.name}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{role.created_at}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{role.updated_at}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap" v-if="$page.props.auth.can.manageRoles">
                        <div class="flex justify-center pr-3">
                            <green-button :href="route('admin.roles.edit', role.id)" class="text-xs">Editar</green-button>
                            <form @submit.prevent="eliminarRol(role.id)">
                                <jet-danger-button type="submit" class="text-sm ml-1">Eliminar</jet-danger-button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr v-if="roles.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No se han encontrado resultados.</td>
                </tr>
                </tbody>
            </table>
            <br>
            <pagination class="mt-6" :links="roles.links" />
        </div>
    </admin-layout>
</template>


<script>
    import { Head } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/AdminLayout'
    import GreenButton from '@/Components/Buttons/GreenButton'
    import OrangeButton from '@/Components/Buttons/OrangeButton'
    import Pagination from '@/Components/Pagination'
    import { pickBy, throttle } from 'lodash';
    import JetDangerButton from '@/Jetstream/DangerButton.vue';
    import JetDialogModal from "@/Jetstream/DialogModal.vue";
    export default {
        props:{
            filters: Object,
            roles: Object,
        },
        components: {
            Head,
            AdminLayout,
            GreenButton,
            OrangeButton,
            Pagination,
            JetDangerButton,
            JetDialogModal,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.name
                }),
                params: {
                    search: this.filters.search,
                    field: this.filters.field,
                    direction: this.filters.direction,
                },
                openModal: false
            }
        },
        methods:{
            sort(field) {
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
            },
            reset(){
                this.filters.search = null
                this.$inertia.get(this.route('admin.roles.index'))
            },
            eliminarRol(id){
                this.$inertia.delete(this.route('admin.roles.destroy', id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "Rol eliminado correctamente",
                        })
                    },
                })
            },
            crearRol(){
                this.form.post(this.route('admin.roles.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "Rol creado correctamente",
                        })
                        this.form.name = null
                    },
                })
                this.openModal = false
            },
        },
        watch: {
            params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
        
                this.$inertia.get(this.route('admin.roles.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
            },
        },
    }
</script>

<style lang="css" scoped>
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }

    
</style>