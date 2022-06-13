<template>
    <Head :title="`${this.$page.props.profile.username}` + ' - DevTea'" />
    <pages-layout>
        <template #title>
            <div class="h-3/4 sm:h-40 overflow-hidden shadow-lg">
                <img
                    class="w-full rounded-t"
                    :src="$page.props.profile.profile_header_photo_url"
                    alt="Header del perfil"
                />
            </div>
            <div class="flex justify-start px-5 -mt-12 mb-5">
                <span class="block relative h-20 w-32">
                    <img
                        alt="Avatar del perfil"
                       :src="$page.props.profile.profile_photo_path"
                        class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1"
                    />
                </span>
            </div>
         
            <div class="flex justify-between px-7 mb-2 rounded w-full">
                <h2 class="mr-3 text-3xl font-semi-bold text-sky-800">
                    {{$page.props.profile.name}} {{$page.props.profile.surname}} 
                    
                </h2>
                
                <div class="flex justify-end">
                    <status
                        :profile="profile"
                        :isFriendsWith="isFriendsWith"
                        :friendRequestSentTo="friendRequestSentTo"
                        :friendRequestReceivedFrom="friendRequestReceivedFrom"
                    ></status>
                </div>
            </div>

            <div class="px-7 mb-8 shadow-lg justify-between">
                 <p class="mt-2 text-gray-500">
                    {{$page.props.profile.bio}}
                </p>
                <green-button class="mt-7 mb-7 py-2 px-3 mr-2 text-xs text-right text-white
                        rounded-lg hover:bg-regal-blue focus:ring-4 focus:outline-none focus:ring-blue-300" :href="route('profiles.checkout', `${this.$page.props.profile.username}`)">
                    <span class="ml-2">Donar un DevTea 🍵</span>
                </green-button>
             </div>
           
        </template>
        <post-comment-form
            :method="publicarPost"
            :form="form"
            :text="'Publicar'"
        ></post-comment-form>

        <infinite-scroll @cargarMasItems="cargarMasPosts">
            <combined-posts
                :posts="allPosts.data"
                :pagination="pagination"
            ></combined-posts>
        </infinite-scroll>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout";
import Status from "@/Components/FriendStatus/Status";
import CombinedPosts from "@/Components/PostComment/CombinedPosts";
import InfiniteScroll from "@/Components/InfiniteScroll";
import PostCommentForm from "@/Components/PostComment/PostCommentForm";
import GreenButton from '@/Components/Buttons/GreenButton';
import JetButton from '@/Jetstream/Button';
import JetDialogModal from "@/Jetstream/DialogModal.vue";
export default {
    components: {
        Head,
        PagesLayout,
        Status,
        GreenButton,
        CombinedPosts,
        PostCommentForm,
        InfiniteScroll,
        JetButton,
        JetDialogModal
    },
    props: [
        "profile",
        "posts",
        "isFriendsWith",
        "friendRequestSentTo",
        "friendRequestReceivedFrom",
        //'checkoutSessionId'
    ],
    data() {
        return {
            form: this.$inertia.form({
                content: this.content,
                user_id: this.profile.id,
            }),
            allPosts: this.posts,
            parent_id: this.$page.props.profile.id,
            openModal: false
        };
    },
    computed: {
        pagination() {
            return this.allPosts = this.posts
        },
    },
    methods: {
        publicarPost() {
            this.form.post(this.route("posts.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "¡Post publicado!",
                    });
                    this.form.content = null;
                },
            });
        },
        cargarMasPosts() {
            if (!this.allPosts.next_page_url) {
                return;
            }
            return axios.get(this.allPosts.next_page_url).then((resp) => {
                this.allPosts = {
                    ...resp.data,
                    data: [...this.allPosts.data, ...resp.data.data],
                };
            });

        },
        // checkout() {
        //     let apikey = process.env.MIX_STRIPE_KEY
        //     window.Stripe(apikey).redirectToCheckout({
        //         sessionId: this.checkoutSessionId,
        //     });  
        // },
        enviarMensajeDirecto(){
            if(this.profile.id === this.$page.props.user.id){
                Toast.fire({
                        icon: "warning",
                        title: "No puedes enviarte un mensaje a ti mismo.",
                    });
            } else if (this.profile.subscription.status === 'no-active' && this.$page.props.user.subscription.status === 'no-active' || this.profile.subscription.status === 'active' && this.$page.props.user.subscription.status === 'no-active'){
                Toast.fire({
                        icon: "warning",
                        title: "Para enviar mensajes, necesitas estar suscrito/a a DevTea Premium.",
                    });
            }else if(this.profile.subscription.status === 'no-active' && this.$page.props.user.subscription.status === 'active'){
                    Toast.fire({
                        icon: "warning",
                        title: `${this.profile.username}` + " no está suscrito/a a DevTea Premium.",
                    });
            } else {
                // this.$inertia.post(this.route('messages.store'), {
                //     preserveScroll: true,
                //     user_id: this.profile.id,
                //     user_name: this.profile.name,
                //     user_surname: this.profile.surname,
                //     user_photo_url: this.profile.profile_photo_url,
                // });
                alert('mensaje enviado')
            }
        },
    }
}
</script>

<style lang="css" scoped>
    
</style>
