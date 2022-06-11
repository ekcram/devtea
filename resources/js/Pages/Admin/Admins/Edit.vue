<template>
    <admin-layout>
        <Head :title="'Administradores / ' + `${form.username}` + ' - DevTea'" />
            <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-steel-teal hover:text-midnight-green" :href="route('admin.admins.index')">Administradores</Link>
            <span class="text-steel-teal font-medium">/ </span>
            <span class="font-light text-gray-600"> {{ form.username }}</span> 
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
                        <jet-input id="created_at" type="text" class="mt-1 block w-full disabled:opacity-50" v-model="form.created_at" required autofocus></jet-input>
                        <jet-input-error :message="form.errors.created_at" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-2">
                        <div class="inline-block relative">
                            <jet-label for="role" value="Rol" class="text-md text-midnight-green"></jet-label>
                            <select class="block capitalize border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 w-full" v-model="form.roles[0][0].name" tabindex="1">
                                <option v-for="(option, index) in allRoles" :key="index" :value="option.name" :selected="option.name === form.roles[0][0].name">
                                    {{ option.name }}
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <green-button type="submit" class="text-xs ml-4" :class="{'opacity-25':form.processing}" :disabled="form.processing">Actualizar</green-button>
                        <jet-danger-button :href="route('admin.admins.index')" class="text-md ml-4">Cancelar</jet-danger-button>
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
        props: ['admin', 'allRoles'],
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
                    name: this.admin.name,
                    username: this.admin.username,
                    email: this.admin.email,
                    created_at: this.admin.created_at,
                    roles: []
                })
            }
        },
        created() {
            if(this.admin.roles) {
                return this.form.roles.push(this.admin.roles)
            }
        },
        methods: {
            submit() {
                this.form.patch(this.route('admin.admins.update', this.admin.id), this.form)
            }
        }
    }
</script>