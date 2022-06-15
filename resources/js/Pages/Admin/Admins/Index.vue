<template>
<Head title="Administradores - DevTea" />
    <admin-layout>
        <div>
            <div class="text-4xl font-extrabold leading-none tracking-tight font-inter mb-5">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                    Administradores
                    </span>
            </div>

            <!-- <div class="text-center my-4" v-if="$page.props.success">
                <span class="text-2xl bg-blue-500 text-gray-50 px-2 rounded-md">{{ $page.props.success }}</span>
            </div> -->
            
            <!-- Filtro de búsqueda -->
            <div class="flex items-center mr-4 mb-5 w-full max-w-md">
                    <div class="flex w-full bg-white rounded shadow">
                        <input 
                        v-model="params.search"
                        type="search" placeholder="Busca un administrador..."
                        class="relative px-6 py-3 w-full rounded focus:shadow-outline focus:border-green-500" 
                        />
                    </div>
                    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="reset()">Limpiar</button>
            </div>

            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-steel-teal font-extrabold text-white rounded">
                    <tr>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Avatar
                        </div>
                        </th>
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
                            Apellidos
                        </div>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Username
                        </div>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Email
                        </div>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Teléfono
                        </div>
                        </th>
                        <th class="p-4 text-center whitespace-nowrap">
                        <div class="flex items-center">
                            Acciones
                        </div>
                        </th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-100">
                <tr v-for="(admin,index) in admins.data" :key="index">
                    <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                        <img class="h-10 w-10 rounded-full object-cover ml-3"
                            :src="admin.profile_photo_url"
                        />
                    </td>
                    <td class="p-4 font-medium text-gray-900 whitespace-nowrap">{{admin.name}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{admin.surname}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{admin.username}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{admin.email}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap">{{admin.phone}}</td>
                    <td class="p-4 text-gray-700 whitespace-nowrap" v-if="$page.props.auth.can.manageAdmins">
                            <div class="flex justify-end pr-3">
                                <green-button :href="route('admin.admins.edit', admin.id)" class="text-xs">Editar</green-button>
                            </div>
                    </td>
                </tr>
                <tr v-if="admins.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No se han encontrado resultados.</td>
                </tr>
                </tbody>
            </table>
            <br>
            <pagination class="mt-6" :links="admins.links" />
        </div>
    </admin-layout>
</template>


<script>
    import { Head } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/AdminLayout'
    import GreenButton from '@/Components/Buttons/GreenButton'
    import Pagination from '@/Components/Pagination'
    import { pickBy, throttle } from 'lodash';
    export default {
        props:{
            filters: Object,
            admins: Object,
        },
        components: {
            AdminLayout,
            GreenButton,
            Pagination,
            Head
        },
        data() {
            return {
                params: {
                    search: this.filters.search,
                    field: this.filters.field,
                    direction: this.filters.direction,
                },
            }
        },
        methods:{
            sort(field) {
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
            },
            reset(){
                this.filters.search = null
                this.$inertia.get(this.route('admin.admins.index'))
            }
        },
        watch: {
            params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
        
                this.$inertia.get(this.route('admin.admins.index'), params, { replace: true, preserveState: true });
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