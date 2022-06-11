<template>
    <div>
        <div v-for="(post, key) in posts" :key="key">
            <post-item :post="post"></post-item>
        </div>
    </div>
</template>

<script>
import PostItem from './PostItem.vue'
export default {
    components: {
        PostItem
    },
    props: [
        'posts'
    ]
};
</script>
