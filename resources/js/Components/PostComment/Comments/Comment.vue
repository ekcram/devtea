<template>
    <div class="relative">
        <button
            type="submit"
            class="focus:outline-none"
            @click="openComment = !openComment"
        >
            <icon name="reply" class="w-4 h-4 ml-3 fill-current"></icon>
        </button>
        <div
            v-if="openComment"
            class="shadow-lg text-sm p-3 rounded-md transition duration-150 ease-in-out"
        >
            <form @submit.prevent="method">
                <post-comment-form
                    :method="enviarComentario"
                    :form="commentForm"
                    :text="'Comentar'"
                ></post-comment-form>
            </form>
        </div>
    </div>
</template>

<script>
import PostCommentForm from "@/Components/PostComment/PostCommentForm";

export default {
    props: ["post", "method"],
    components: {
        PostCommentForm,
    },
    data() {
        return {
            openComment: false,
            commentForm: this.$inertia.form({
                content: this.content,
                user_id: this.post.user_id,
            }),
        };
    },
    methods: {
        enviarComentario() {
            this.openComment = false;
            this.commentForm.post(route("comments.store", this.post), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "¡Comentario publicado!",
                    });
                    this.commentForm.content = null;
                },
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
