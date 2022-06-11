<template>
    <aside class="flex fixed flex-col bg-white shadow-lg py-6 w-full lg:h-screen md:h-screen sm:h-screen xs:h-full sm:w-1/3 md:w-60 lg:w-60">
       <jet-nav-link :href="link.route"
       v-for="link in sideBarLinks" :key="link.name" 
       :active="route().current(link.route)">
            <img :src="link.image" :alt="link.alt" class="h-8 w-8 rounded-full object-cover" v-if="link.image">
            <icon :name="link.icon" class="fill-current w-6 h-6" v-if="link.icon"></icon>
            <span class="ml-2 ">
                {{ link.name }}
            </span>
            <span v-if="link.name === 'DevTalk'">
                <span class="rounded p-1 ml-2 border border-red-salsa text-red-salsa text-[10px]">Premium</span>
            </span>
             <span v-if="link.name === 'Proyectos'">
                <span class="rounded p-1 ml-2 border border-red-salsa text-red-salsa text-[10px]">Premium</span>
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
                    name: `${this.$page.props.user.username}`,
                    image: `${this.$page.props.user.profile_photo_url}`,
                    alt: `${this.$page.props.user.username}`,
                    route: route(
                        "profiles.show",
                        `${this.$page.props.user.username}`//profile.show
                    ),
                },
                {
                    name: "Inicio",
                    route: route("dashboard.index"),
                    icon: "house-chimney",
                },
                {
                    name: "DevFriends",
                    route: route("friends.index"),
                    icon: "users",
                },
                {
                    name: "Explorar",
                    route: route("members.index"),
                    icon: "magnifying-glass",
                },
                {
                    name: "Proyectos",
                    route: route("projects.index"),
                    icon: "code",
                },
                {
                    name: "DevTalk",
                    route: route("doubts.index"),
                    icon: "comments",
                },
                {
                    name: "Membership",
                    route: route("subscription.index"),
                    icon: "id-card",
                },
                {
                    name: "Ajustes",
                    route: route("profile.show"),
                    icon: "sliders",
                },
                {
                    name: "Ayuda General",
                    route: route("help.index"),
                    icon: "circle-question",
                },
                {
                    name: "Acerca de",
                    route: route("about.index"),
                    icon: "circle-info",
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
