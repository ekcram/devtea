<template>
    <Head title="Inicio - DevTea" />
    <pages-layout>
        <template #title> 
               <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2 py-2">
                    ¡Hola, {{ this.$page.props.user.username }}! 👨🏻‍💻
                    </span>
                </div>
        </template>
        
        <div class="flex inline-flex items-between">
            <!-- DIV Escribir Post -->
            <button class="flex flex-col relative group h-40 mr-5" @click="openFormPost = !openFormPost">
                <span class="absolute inset-0 border-2 border-steel-teal border-dashed"></span>

                <div class="relative flex items-end h-full transition-transform transform bg-white border-2 border-steel-teal group-hover:-translate-x-2 group-hover:-translate-y-2">
                    <div class="px-8 pb-8 transition-opacity group-hover:opacity-0 group-hover:absolute">
                        <span class="text-4xl">✍🏻</span>
                        <h2 class="mt-4 text-2xl font-medium">Escribir un post</h2>
                    </div>
                    <div class="absolute p-8 transition-opacity opacity-0 group-hover:opacity-100 group-hover:relative">
                        <span class="text-4xl">✍🏻</span>
                        <h2 class="mt-4 text-2xl font-medium">Escribir un post</h2>
                    </div>
                </div>
            </button>
            <!-- DIV Crear Tema de discusión -->
            <a v-if="this.$page.props.user.subscription.status == 'active'" :href="route('doubts.index')" class="flex flex-col relative group h-40">
                <span class="absolute inset-0 border-2 border-steel-teal border-dashed"></span>

                <div class="relative flex items-end h-full transition-transform transform bg-white border-2 border-steel-teal group-hover:-translate-x-2 group-hover:-translate-y-2">
                    <div class="text-center px-8 pb-8 transition-opacity group-hover:opacity-0 group-hover:absolute">
                        <span class="text-4xl">💬</span>
                        <h2 class="mt-4 text-2xl font-medium">Crear un tema de discusión</h2>
                    </div>
                    <div class="text-center absolute p-8 transition-opacity opacity-0 group-hover:opacity-100 group-hover:relative">
                        <span class="text-4xl">💬</span>
                        <h2 class="mt-4 text-2xl font-medium">Crear un tema de discusión</h2>
                    </div>
                </div>
            </a>
            <!-- DIV DevTeas recibidos(donados) -->
             <div class="flex flex-col relative group h-40 ml-5">
                <span class="absolute inset-0 border-2 border-steel-teal border-dashed"></span>

                <div class="relative flex items-end h-full transition-transform transform bg-white border-2 border-steel-teal group-hover:-translate-x-2 group-hover:-translate-y-2">
                    <div class="text-center px-8 pb-8 transition-opacity group-hover:opacity-0 group-hover:absolute">
                        <span class="text-4xl">🍵</span>
                        <h2 class="mt-4 text-2xl font-medium">DevTeas recibidos: <span class="text-steel-teal text-bold">{{this.donations}}</span></h2>
                    </div>
                    <div class="text-center absolute p-8 transition-opacity opacity-0 group-hover:opacity-100 group-hover:relative">
                        <span class="text-4xl">🍵</span>
                        <h2 class="mt-4 text-2xl font-medium">DevTeas recibidos: <span class="text-steel-teal text-bold">{{this.donations}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
       
        <div v-if="openFormPost">
            <post-comment-form :method="publicarPost" :form="form" :text="'Publicar'"></post-comment-form>
        </div>  

        <infinite-scroll @cargarMasItems="cargarMasPosts">
            <combined-posts :posts="allPosts.data" :pagination="pagination"></combined-posts>
        </infinite-scroll>

        <suggestion-block :suggestions="suggestions"></suggestion-block>

    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout.vue";
import CombinedPosts from '@/Components/PostComment/CombinedPosts'
import PostCommentForm from '@/Components/PostComment/PostCommentForm'
import SuggestionBlock from '@/Components/SuggestionBlock'
import InfiniteScroll from '@/Components/InfiniteScroll'

export default {
    components: {
        Head,
        PagesLayout,
        CombinedPosts,
        PostCommentForm,
        SuggestionBlock,
        InfiniteScroll,
    },
    props: [
        'combinedPosts',
        'suggestions',
        'donations'
    ],
    data() {
        return {
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                content: this.content,
            }),
            allPosts: this.combinedPosts,
            openFormPost: false,
        };
    },
    computed:{
        pagination(){
            return this.allPosts = this.combinedPosts
        }
    },
    methods: {
        publicarPost(){
            this.openFormPost = false
            this.form.post(this.route('posts.store'), {
                preserveScroll: true,
                onSuccess: ()=> {
                     Toast.fire({
                            icon: "success",
                            title: "¡Post publicado!",
                        })
                    this.form.content = null
                    
                }
            })
        },
        cargarMasPosts(){
            if(!this.allPosts.next_page_url){
                return
            } 
            return  axios.get(this.allPosts.next_page_url).then(resp => {
                this.allPosts = {
                       ...resp.data,
                       data: [
                           ...this.allPosts.data, ...resp.data.data
                       ]
                }
            })
        }
    },   
};
</script>

<style lang="css" scoped>
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>
