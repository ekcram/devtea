<template>
    <admin-layout>
        <Head :title="'Usuarios / ' + `${form.name} ${form.surname}` + ' - DevTea'" />
            <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-steel-teal hover:text-midnight-green" :href="route('admin.users.index')">Usuarios</Link>
            <span class="text-steel-teal font-medium">/ </span>
            <span class="font-light text-gray-600"> {{ form.name }} {{form.surname}}</span> 
            </h1>
        
        <div class="grid px-6 py-5 w-3/4 bg-mint-cream rounded shadow-lg">
            <div>
                <form @submit.prevent="submit">
                    <div class="flex flex-col mt-2">
                        <jet-label for="name" value="Nombre" class="text-md text-midnight-green"></jet-label>
                        <jet-input id="name" type="text" class="mt-1 block w-full disabled:opacity-50" v-model="form.name" required autofocus></jet-input>
                        <jet-input-error :message="form.errors.name" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-2">
                        <jet-label for="email" value="Email" class="text-md text-midnight-green"></jet-label>
                        <jet-input id="email" type="email" class="mt-1 block w-full disabled:opacity-50" v-model="form.email" required autofocus></jet-input>
                        <jet-input-error :message="form.errors.email" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-2">
                        <jet-label for="created_at" value="Joined" class="text-md text-midnight-green"></jet-label>
                        <jet-input id="created_at" type="text" class="mt-1 block w-full disabled:opacity-50" v-model="form.created_at" required autofocus disabled></jet-input>
                        <jet-input-error :message="form.errors.created_at" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <green-button type="submit" class="text-xs ml-4" :class="{'opacity-25':form.processing}" :disabled="form.processing">Actualizar</green-button>
                        <jet-danger-button :href="route('admin.users.index')" class="text-md ml-4">Cancelar</jet-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/AdminLayout'
    import GreenButton from '@/Components/Admin/GreenButton'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    export default {
        props: ['user', 'allRoles'],
        components: {
            AdminLayout,
            GreenButton,
            JetDangerButton,
            JetInput,
            JetInputError,
            JetLabel,
            Head,
            Link
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    surname: this.user.surname,
                    email: this.user.email,
                    created_at: this.user.created_at,
                    roles: []
                })
            }
        },
        created() {
            if(this.user.roles) {
                return this.form.roles.push(this.user.roles)
            }
        },
        methods: {
            submit() {
                this.form.patch(this.route('admin.users.update', this.user.id), this.form,{
                    onSuccess: () => {
                         Toast.fire({
                            icon: "success",
                            title: "Usuario actualizado correctamente",
                        })
                    }
                })
            }
        }
    }
</script>