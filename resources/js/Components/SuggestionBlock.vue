
<template>
    <div class="flex flex-col mt-16">
        <!-- <h3 class="font-bold text-lg text-indigo-800 leading-tight mt-5">Usuarios que quizás quieras seguir:</h3> -->
        <!-- <div class="flex mb-5 pb-5">
            <div v-for="user in suggestions" :key="user.id" class="w-1/5">
                <inertia-link :href="route('profiles.show', user.username)" class="sm:w-1/2">
                    <div class="flex flex-col items-center px-2 py-3 border-l border-gray-400 mt-5 hover:bg-gray-200">
                        <img class="h-8 w-8 rounded-full object-cover mb-2" :src="user.profile_photo_url" :alt="user.username" :title="user.username" />
                        <span>{{user.username}}</span>
                        <icon name="eye" class="w-6 h-6 fill-current ml-1"></icon>
                    </div>

                </inertia-link>
            </div>
        </div> -->
        <section>
            <div class="text-2xl font-extrabold leading-none tracking-tight font-inter">
                <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                    Usuarios recomendados
                </span>
            </div>
            <div class="max-w-screen-xl px-4 py-6 mx-auto sm:px-6 md:px-6 lg:px-8">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="user in suggestions" :key="user.id">
                            <blockquote class="p-8 bg-gray-100 rounded">
                                <div class="flex items-center">
                                    <img
                                    :src="user.profile_photo_url" :alt="user.username" :title="user.username"
                                        class="object-cover w-16 h-16 rounded-full"/>
                                    <div class="ml-4 text-xl text-steel-teal">
                                        <p class="font-medium">{{user.username}}</p>
                                    </div>
                                </div>

                                <p class="relative mt-4 text-gray-500">
                                    <span class="text-xl"></span>{{user.bio}}<span class="text-xl"></span>
                                </p>
                                <div class="flex items-center mt-4">
                                    <green-button>
                                        <inertia-link :href="route('profiles.show', user.username)" class="text-white">
                                            Ver perfil 👀
                                        </inertia-link>
                                    </green-button>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                    <div class="mt-12 swiper-pagination"></div>
                </div>
            </div>
        </section>
    </div>

</template>

<script>
import GreenButton from '@/Components/Buttons/GreenButton';
    export default {
        props: ['suggestions'],
        components: {
            GreenButton,
        },
        beforeMount() {
           document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.swiper-container', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 8,
                autoplay: {
                    delay: 8000,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                    slidesPerView: 1,
                    },
                    1024: {
                    slidesPerView: 1,
                    },
                    1340: {
                    slidesPerView: 2
                    }

                },
                })
            })
        }
    }
</script>

<style lang="css" scoped>
.swiper-pagination {
    bottom: 0;
    position: relative;
  }
  .swiper-container {
    overflow: hidden;
  }
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>