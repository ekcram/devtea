<template>
    <admin-layout>
        <Head :title="'Roles / ' + `${form.name}` + ' - DevTea'" />
            <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-steel-teal hover:text-midnight-green" :href="route('admin.roles.index')">Roles</Link>
            <span class="text-steel-teal font-medium">/ </span>
            <span class="font-light text-gray-600"> {{ form.name }}</span> 
            </h1>

        <div class="grid px-6 py-5 w-3/4 bg-mint-cream rounded shadow-lg">
           <div>
               <form @submit.prevent="crearRol">
                   <div class="mt-4">
                       <jet-label for="name" value="Nombre del Rol" class="text-md text-midnight-green"></jet-label>
                       <jet-input id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" autofocus
                       ></jet-input>
                       <jet-input-error :message="form.errors.name" class="mt-2"></jet-input-error>
                   </div>
                   <div class="flex items-center justify-center mt-4">
                       <green-button type="submit" class="text-xs" :class="{'opacity-25':form.processing}" :disabled="form.processing">Actualizar</green-button>
                       <jet-danger-button :href="route('admin.roles.index')" class="text-md ml-4">Cancelar</jet-danger-button>
                   </div>
               </form>
           </div>
        </div>
    </admin-layout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AdminLayout from "@/Layouts/AdminLayout";
import GreenButton from '@/Components/Admin/GreenButton';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetInputError from '@/Jetstream/InputError.vue';
export default {
    components: {
        Head,
        Link,
        AdminLayout,
        GreenButton,
        JetDangerButton,
        JetInput,
        JetLabel,
        JetInputError,
    },
    props: ['role'],
    data() {
        return {
            form: this.$inertia.form({
                name: this.role.name
            })
        };
    },
    methods: {
        crearRol() {
            this.form.patch(this.route('admin.roles.update', this.role.id), this.form)
        }
    }
};
</script>

<style lang="scss" scoped></style>
