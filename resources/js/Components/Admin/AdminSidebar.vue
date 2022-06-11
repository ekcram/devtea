<template>
    <aside class="flex fixed flex-col bg-white shadow-lg py-6 w-full lg:h-screen md:h-screen sm:h-screen xs:h-full sm:w-1/3 md:w-60 lg:w-60">
       <jet-nav-link :href="link.route"
       v-for="link in sideBarLinks" :key="link.name" 
       class="flex items-end pl-6 py-2 rounded" 
       :active="route().current(link.route)">
            <img :src="link.image" :alt="link.alt" class="h-8 w-8 rounded-full object-cover" v-if="link.image">
            <icon :name="link.icon" class="fill-current w-6 h-6" v-if="link.icon"></icon>
            <span class="ml-2">
                {{ link.name }}
            </span>
        </jet-nav-link>
    </aside>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink.vue";

export default {
    components:{
        JetNavLink
    },
    computed: {
        sideBarLinks() {
            return [
                {
                    name: "Dashboard",
                    route: route("admin.dashboard"),
                    icon: "house-chimney",
                },
                {
                    name: "Admins",
                    route: route("admin.admins.index"),
                    icon: "users-gear",
                },
                {
                    name: "Usuarios",
                    route: route("admin.users.index"),
                    icon: "users",
                },
                {
                    name: "Roles",
                    route: route("admin.roles.index"),
                    icon: "user-lock",
                },
            ];
        },
    },
};
</script>

<style lang="css" scoped>

@media (max-width: 640px) { 
    aside {
        display: none;
    }
 }
</style>

