<template>
    <div class="flex mt-5 sm:mt-0">
         <template v-if="friendRequestReceivedFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-3"></ignore>
        </template>

        <template v-else-if="friendRequestSentTo">
            <h3 class="font-semibold text-md text-gray-800 leading-tight">
                Pendiente
            </h3>
        </template>

        <template v-else-if="isFriendsWith">
            <form @submit.prevent="deleteFriend">
                <jet-danger-button type="submit">
                    <dot-loader
                        v-if="loading"
                        :loading="loading"
                        :color="color"
                        :size="size"
                    ></dot-loader>
                    
                    <span class="ml-2">Eliminar amigo</span>
                    <icon
                        name="user-slash"
                        class="w-4 h-4 fill-current ml-1"
                    ></icon>
                    
                </jet-danger-button>
            </form>
        </template>

        <template v-else-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <orange-button type="submit" class="text-xs">
                    <dot-loader
                        v-if="loading"
                        :loading="loading"
                        :color="color"
                        :size="size"
                    ></dot-loader>
                    
                    <span class="ml-2">Añadir</span>
                    <icon
                        name="user-plus"
                        class="w-4 h-4 fill-current ml-1"
                    ></icon>
                    
                </orange-button>
            </form>
        </template>
    </div>
</template>

<script>
import OrangeButton from "@/Components/Buttons/OrangeButton";
import Accept from "./Accept";
import Ignore from "./Ignore";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
    data() {
        return {
            loading: false,
            color: "white",
            size: "16",
            addFriendForm: this.$inertia.form({
                user: this.profile,
            }),
            deleteFriendForm: this.$inertia.form({
                user: this.profile,
            }),
        };
    },
    props: [
        "profile",
        "isFriendsWith",
        "friendRequestSentTo",
        "friendRequestReceivedFrom",
    ],
    components: {
        OrangeButton,
        JetDangerButton,
        Accept,
        Ignore,
    },
    methods: {
         addFriend() {
            this.loading = true
            this.addFriendForm.post(
                this.route("friends.store", this.profile.id),
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "¡Petición de amistad enviada!",
                            background: 'green',
                        })
                        this.loading = false
                    }
                }
            )
        },
        deleteFriend() {
            this.loading = true;
            this.deleteFriendForm.delete(
                this.route("friends.destroy", this.profile.id),
                {
                    preserveScroll: true,
                    onSuccess: () => {
                         Toast.fire({
                            icon: "success",
                            title: "¡Amigo eliminado correctamente!",
                        })
                        this.loading = false;
                    },
                }
            );
        },
    },
};
</script>


