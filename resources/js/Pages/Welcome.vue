<template>
    <body class="bg-white font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login/Register Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                 <img
                    :src="'/storage/images/logo.png'"
                    alt="Devtea Demo"
                    class="h-6/7 w-16"
                />
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-6xl font-extrabold text-midnight-green font-inter mb-5">DevTea 🍵</p>
                <div v-if="canLogin" class="flex justify-center space-x-6 mt-5">
                        <green-button
                            href="#"
                            v-if="$page.props.user"
                            class="text-lg text-gray-700 underline"
                        >
                            Dashboard
                        </green-button>
                        <template v-else>
                            <green-button
                                :href="route('login')"
                                class="rounded px-3 py-1"
                            >
                                Iniciar sesión
                            </green-button>
                            <green-button
                                v-if="canRegister"
                                :href="route('register')"
                                class="px-3 py-1"
                            >
                                Registrarse
                            </green-button>
                        </template>
                    </div>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" :src="'/storage/images/fondo-login.png'">
        </div>
    </div>

</body>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import GreenButton from '@/Components/Buttons/GreenButton';

export default defineComponent({
    components: {
        Head,
        Link,
        GreenButton
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
});
</script>
