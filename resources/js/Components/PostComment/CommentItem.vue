<template>
<div>
    <div class="flex mt-5 py-5 space-x-5">
        <div class="flex-shrink-0">
            <inertia-link :href="route('profiles.show', comment.user.username)">
                <img class="h-6 w-6 rounded-full object-cover" :src="comment.user.profile_photo_url" :alt="comment.user.username">
            </inertia-link>
        </div>

        <div class="flex-1">
            <div>
                <h2 class="text-sm text-steel-teal font-semibold">
                    <inertia-link :href="route('profiles.show', comment.user.username)">{{ comment.user.username }}</inertia-link>
                    </h2>
                <p class="rounded mt-3 px-3 py-2 w-3/4" v-html="comment.content">
                </p>
            </div>
            <div class="flex items-end my-3">
                <div>
                    <span class="text-sm italic">{{  $filters.timeAgo(comment.created_at) }}</span>
                </div>
                <div class="flex ml-3">
                    <like :item="comment" :method="enviarLike"></like>
                    <dislike :item="comment" :method="enviarDislike" class="ml-2"></dislike>
                </div>
            </div>
        </div>
    </div>
</div>
    
</template>

<script>
import Like from '@/Components/PostComment/Likes/Like';
import Dislike from '@/Components/PostComment/Likes/Dislike';
export default {
    props:['comment'],
    components:{
        Like,
        Dislike,
    },
    data() {
        return {
            likeForm: this.$inertia.form({
                comment: this.comment
            }),
            dislikeForm: this.$inertia.form({
                comment: this.comment
            }),
        };
    },
    methods: {
        enviarLike() {
            this.likeForm.post(this.route('comment-like.store', this.comment.id), {
                preserveScroll: true,
                onSuccess:()=>{

                }
            })
        },
        enviarDislike() {
            this.dislikeForm.delete(this.route('comment-like.destroy', this.comment.id), {
                preserveScroll: true,
                onSuccess:()=>{

                }
            })
        },
    }
};
</script>

<style lang="css" scoped>
    p {
        background-color: #dfebff;
    }
</style>

