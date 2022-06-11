<template>
    <Head title="Admin Dashboard - DevTea" />
    <admin-layout title="Dashboard">
        <section class="text-white bg-green-sheen border rounded">
            <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold sm:text-6xl">
                        Bienvenido, {{ this.$page.props.user.name}}.
                    </h2>

                    <p class="mt-4 sm:text-xl">
                        Estás en el panel de administración de DevTea. Aquí tienes un resumen de las estadísticas de la aplicación.
                    </p>
                </div>

                <ul class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3">
                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.admins}}</p>
                        <p class="mt-1 text-xl font-medium">Admins</p>
                    </li>

                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.users}}</p>
                        <p class="mt-1 text-xl font-medium">Usuarios</p>
                    </li>

                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.roles}}</p>
                        <p class="mt-1 text-xl font-medium">Roles</p>
                    </li>

                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.usersSubscribed}}</p>
                        <p class="mt-1 text-xl font-medium">Usuarios con membresía</p>
                    </li>

                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.totalDonations}} €</p>
                        <p class="mt-1 text-xl font-medium">Total DevTeas donados</p>
                    </li>

                    <li class="p-8 shadow-xl rounded-xl">
                        <p class="text-3xl font-extrabold">{{this.totalSubscriptions}} €</p>
                        <p class="mt-1 text-xl font-medium">Total subscripciones</p>
                    </li>
                </ul>
            </div>
        </section>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AdminLayout,
        Head
    },
    props:{
        admins:{
            type: Number,
            default: 0
        },
        users:{
            type: Number,
            default: 0
        },
        roles:{
            type: Number,
            default: 0
        },
        usersSubscribed:{
            type: Number,
            default: 0
        },
        totalDonations:{
            type: Number,
            default: 0
        },
        totalSubscriptions:{
            type: Number,
            default: 0
        },
    },
    data() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
