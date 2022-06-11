<template>
    <form @submit.prevent="acceptFriend">
        <green-button type="submit" class="text-xs">
            <dot-loader v-if="loading" :loading="loading" :color="color" :size="size"></dot-loader>
              <span class="ml-2">Aceptar</span>
             <icon name="check" class="w-4 h-5 fill-current ml-1"></icon>
        </green-button>
    </form>
</template>

<script>
    import GreenButton from '@/Components/Buttons/GreenButton'
    export default {
        props: ['profile'],
        components: {
            GreenButton,
        },
        data() {
            return {
                acceptFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading: false,
                color: 'white',
                size: '16',
            }
        },
        methods: {
            acceptFriend() {
                this.loading = true
                this.acceptFriendForm.patch(this.route('friends.update', this.profile.id), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: "success",
                            title: "¡Amigo añadido!",
                        })
                        this.loading = false
                    }
                })
            }
        }
    }
</script>