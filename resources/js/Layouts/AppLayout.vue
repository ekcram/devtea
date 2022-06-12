<template>
    <div>
        <div class="flex flex-col min-h-screen">
            <nav class="bg-white border-b border-gray-200 w-full fixed z-20">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link
                                    :href="route('dashboard.index')"
                                    class="h-4/5 w-14"
                                >
                                    <img
                                        :src="'/storage/images/logo.png'"
                                        alt="Logo"
                                    />
                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm: justify-end w-1/2 sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="flex items-center ml-3 relative">
                                <!-- Notificationes-->
                                <jet-dropdown align="right" width="96">
                                    <template #trigger>
                                        <button class="mt-1 focus:outline-none">
                                            <div
                                                class="flex items-center ml-2 mr-3 relative"
                                            >
                                                <icon
                                                    name="bell"
                                                    class="w-6 h-6"
                                                ></icon>
                                                <template
                                                    v-if="
                                                        unreadNotifications.length >
                                                        0
                                                    "
                                                >
                                                    <span
                                                        class="text-white text-xs bg-red-600 rounded-full px-2 py-1 absolute bottom-2 left-3"
                                                    >
                                                        {{
                                                            unreadNotifications.length
                                                        }}
                                                    </span>
                                                </template>
                                            </div>
                                        </button>
                                    </template>

                                    <template #content v-if="notifications.length > 0">
                                        <inertia-link
                                            :href="
                                                route('notifications.update')
                                            "
                                            class="block px-4 py-2 text-sm text-center leading-5 text-slate-900 hover:bg-gray-300 focus:outline-none transition duration-150 ease-in-out"
                                        >
                                            Marcar todo como leído
                                        </inertia-link>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <notifications
                                            :unreads="unreadNotifications"
                                            :reads="readNotifications"
                                        ></notifications>
                                    </template>

                                    <template #content v-else>
                                        <div
                                            class="block text-center px-4 py-2 text-xs text-gray-400"
                                        >
                                            Tienes 0 notificaciones
                                        </div>
                                    </template>
                                </jet-dropdown>
                                <!-- Ir a Inicio -->
                                <Link
                                    class="flex items-center ml-2 mr-3 relative mt-1 focus:outline-none"
                                    :href="route('dashboard.index')"
                                >
                                    <icon
                                        name="house"
                                        class="w-6 h-6"
                                    ></icon>
                                </Link>
                                <!-- Cerrar sesión-->
                                <form @submit.prevent="logout">
                                    <jet-dropdown-link as="button" class="flex items-center mr-2 relative mt-1 focus:outline-none">
                                        <icon name="sign-out" class="w-6 h-6"></icon>
                                    </jet-dropdown-link>
                                </form>
                             
                                <!-- Ir a Opciones de Perfil -->
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-transparent transition duration-150 ease-in-out"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover ml-3"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <button
                                            type="button"
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-transparent transition duration-150 ease-in-out"
                                            v-else
                                        >
                                            <div>
                                                {{ $page.props.user.username }}
                                            </div>
                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Administrar cuenta
                                        </div>

                                        <jet-dropdown-link
                                            class="customLink"
                                            :href="route('profile.show')"
                                        >
                                            Ajustes
                                        </jet-dropdown-link>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Cerrar sesión
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <jet-dropdown align="right" width="96">
                                <template #trigger>
                                    <button class="mt-1 focus:outline-none">
                                        <div
                                            class="flex items-center ml-2 mr-3 relative"
                                        >
                                            <icon
                                                name="bell"
                                                class="w-6 h-6"
                                            ></icon>
                                            <template
                                                v-if="
                                                    unreadNotifications.length >
                                                    0
                                                "
                                            >
                                                <span
                                                    class="text-white text-xs bg-red-600 rounded-full px-2 py-1 absolute bottom-2 left-3"
                                                >
                                                    {{
                                                        unreadNotifications.length
                                                    }}
                                                </span>
                                            </template>
                                        </div>
                                    </button>
                                </template>

                                <template
                                    #content
                                    v-if="notifications.length > 0"
                                >
                                    <inertia-link
                                        :href="route('notifications.update')"
                                        class="block px-4 py-2 text-sm text-center leading-5 text-slate-900 hover:bg-gray-300 focus:outline-none transition duration-150 ease-in-out"
                                    >
                                        Marcar todo como leído
                                    </inertia-link>

                                    <div class="border-t border-gray-100"></div>

                                    <notifications
                                        :unreads="unreadNotifications"
                                        :reads="readNotifications"
                                    ></notifications>
                                </template>

                                <template #content v-else>
                                    <div
                                        class="block text-center px-4 py-2 text-xs text-gray-400"
                                    >
                                        Tienes 0 notificaciones
                                    </div>
                                </template>
                            </jet-dropdown>
                            <Link
                                    class="flex items-center ml-2 mr-3 relative mt-1 focus:outline-none"
                                    :href="route('dashboard.index')"
                                >
                                    <icon
                                        name="house"
                                        class="w-6 h-6"
                                    ></icon>
                            </Link>

                            <!-- Cerrar sesión-->
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button" class="flex items-center mr-2 relative mt-1 focus:outline-none">
                                    <icon name="sign-out" class="w-6 h-6"></icon>
                                </jet-dropdown-link>
                            </form>
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown,hidden: !showingNavigationDropdown,}" class="sm:hidden">
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div
                                v-if="
                                    $page.props.jetstream.managesProfilePhotos
                                "
                                class="shrink-0 mr-3"
                            >
                                <Link
                                    :href="route('profiles.show',  `${this.$page.props.user.username}`)"
                                    class="h-4/5 w-16"
                                >
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        :src="$page.props.user.profile_photo_url"
                                        :alt="$page.props.user.name"
                                    />
                                </Link>
                            </div>

                            <div>
                                <div
                                    class="font-large text-base text-steel-teal font-bold"
                                >
                                    {{ $page.props.user.name }}
                                </div>
                                <div class="font-medium text-sm text-steel-teal">
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')" class="text-green-sheen">
                                Inicio
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('friends.index')" :active="route().current('friends.index')" class="text-green-sheen">
                                DevFriends
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('members.index')" :active="route().current('memberes.index')" class="text-green-sheen">
                                Explorar
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('projects.index')" :active="route().current('projects.index')" class="text-green-sheen">
                                Proyectos
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('doubts.index')" :active="route().current('doubts.index')" class="text-green-sheen">
                                DevTalk
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link href="#" class="text-green-sheen">
                                Membership
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')" class="text-green-sheen">
                                Ajustes
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('about.index')" :active="route().current('about.index')" class="text-green-sheen">
                                Acerca de
                            </jet-responsive-nav-link>
                            <jet-responsive-nav-link :href="route('help.index')" :active="route().current('help.index')" class="text-green-sheen">
                                Ayuda general
                            </jet-responsive-nav-link>
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button" class="text-green-sheen">
                                    Cerrar sesión
                                </jet-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex flex-wrap pt-16 sm:flex-nowrap">
                <!-- Page Sidebar -->
                <side-bar v-if="$page.props.user.is_admin === 0"></side-bar>
                <!-- Page Content -->
                <div class="w-1/4 sm:w-1/3 md:w-1/4 lg:w-1/5"></div>
                <main
                    class="bg-white rounded my-5 py-6 px-4 w-full sm:w-2/3 sm:mx-2 sm:my-3 md:mx-4 md:px-10 lg:mx-0">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import SideBar from "@/Components/SideBar";
import Notifications from "@/Components/Notifications";

export default defineComponent({
    mounted() {
        this.listen();
    },
    props: {
        title: String,
    },

    components: {
        Head,
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        SideBar,
        Link,
        Notifications,
    },
    data() {
        return {
            showingNavigationDropdown: false,
            notifications: this.$page.props.auth.notifications,
            readNotifications: this.$page.props.auth.readNotifications,
            unreadNotifications: this.$page.props.auth.unreadNotifications,
        };
    },

    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        listen() {
            Echo.private(
                `App.Models.User.${this.$page.props.user.id}`
            ).notification((notification) => {
                let newUnreadNotifications = {
                    data: {
                        info: {
                            avatar: notification.info.avatar,
                            message: notification.info.message,
                            link: notification.info.link,
                            sent: notification.info.sent,
                        },
                    },
                    id: notification.id,
                };
                this.unreadNotifications.push(newUnreadNotifications);
                this.notifications.push(newUnreadNotifications);
            });
        },
    },
});
</script>
