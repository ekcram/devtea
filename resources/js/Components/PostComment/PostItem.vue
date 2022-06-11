<template>
    <div class="flex bg-white shadow-lg rounded border border-slate-300 hover:border-green-sheen mt-5 py-5 space-x-5">
        <div class="flex-shrink-0 ml-4">
            <inertia-link :href="route('profiles.show', post.user.username)">
                <img
                    class="h-8 w-8 rounded-full object-cover"
                    :src="post.user.profile_photo_url"
                    :alt="post.user.username"
                />
            </inertia-link>
        </div>

        <div class="flex-1">
            <div>
                <div class="flex justify-between">
                    <h2 class="text-sm text-steel-teal font-semibold">
                        <inertia-link
                            :href="route('profiles.show', post.user.username)"
                            >{{ post.user.username }}</inertia-link
                        >
                    </h2>
                    <div class="relative mr-3">
                        <button
                            type="button"
                            class="focus:outline-none"
                            @click="openMenu = !openMenu"
                        >
                            <icon
                                name="ellipsis"
                                class="w-8 h-8 fill-current"
                            ></icon>
                        </button>
                        <div
                            v-if="openMenu"
                            class="bg-gray-100 text-sm absolute w-48 right-0 text-gray-700 shadow-lg rounded-md px-4 py-2 hover:bg-red-600 hover:text-gray-100 transition duration-150 ease-in-out"
                        >
                            <form @submit.prevent="eliminarPost">
                                <button
                                    type="submit"
                                    class="flex justify-between items-center w-full focus:outline-none"
                                >
                                    Eliminar post
                                    <icon
                                        name="trash"
                                        class="w-3 h-3 fill-current"
                                    ></icon>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <p class="rounded mt-3 px-2 py-2 mr-8" v-html="post.content">
                    
                </p>
            </div>

            <div class="flex items-end my-3">
                <div>
                    <span class="text-sm italic">{{
                        $filters.timeAgo(post.created_at)
                    }}</span>
                </div>

                <div class="flex ml-3">
                    <like :item="post" :method="enviarLike"></like>
                    <dislike
                        :item="post"
                        :method="enviarDislike"
                        class="ml-2"
                    ></dislike>
                </div>
                
            </div>
            <comment :post="post"></comment>
            <combined-comments :comments="post.comments"></combined-comments>
        </div>
    </div>
</template>

<script>
import Like from "@/Components/PostComment/Likes/Like";
import Dislike from "@/Components/PostComment/Likes/Dislike";
import Comment from "@/Components/PostComment/Comments/Comment";
import CombinedComments from "@/Components/PostComment/CombinedComments";
import PostCommentForm from "@/Components/PostComment/PostCommentForm";
export default {
    components: {
        Like,
        Dislike,
        CombinedComments,
        Comment,
        PostCommentForm,
    },
    props: ["post"],
    data() {
        return {
            openMenu: false,
            deleteForm: this.$inertia.form({
                userPost: this.post,
            }),
            likeForm: this.$inertia.form({
                userPost: this.post,
            }),
            dislikeForm: this.$inertia.form({
                userPost: this.post,
            }),
        };
    },
    methods: {
        eliminarPost() {
            this.openMenu = false;
            this.deleteForm.delete(this.route("posts.destroy", this.post), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Publicación eliminada.",
                    });
                },
                onError: () => {
                    Toast.fire({
                        icon: "error",
                        title: "No tienes permiso para eliminar esta publicación.",
                    });
                },
            });
        },
        enviarLike() {
            this.likeForm.post(this.route("post-like.store", this.post), {
                preserveScroll: true,
            });
        },
        enviarDislike() {
            this.dislikeForm.delete(
                this.route("post-like.destroy", this.post),
                {
                    preserveScroll: true,
                }
            );
        },
    },
};
</script>

<style lang="css" scoped>
/* p {
    background-color: #dfebff;
} */
</style>
