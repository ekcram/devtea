<template>
    <form @submit.prevent="ignoreRequest">
        <jet-danger-button type="submit" class="text-xs">
            <dot-loader v-if="loading" :loading="loading" :color="color" :size="size"></dot-loader>
             <span class="ml-2">Ignorar</span>
            <icon name="xmark" class="w-3 h-5 fill-current ml-1"></icon>
        </jet-danger-button>
    </form>
</template>

<script>
    import JetDangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile'],
        components: {
            JetDangerButton,
        },
        data() {
            return {
                loading: false,
                color: 'white',
                size: '16',
            }
        },
        methods: {
            ignoreRequest() {
                this.loading = true
                this.$inertia.get(this.route('friends.deny', this.profile.id, {
                    onSuccess:()=>{
                        Toast.fire({
                            icon: "success",
                            title: "Petición de amistad ignorada.",
                        })
                        this.loading = false
                    }
                }))
            }
        }
    }
</script>
