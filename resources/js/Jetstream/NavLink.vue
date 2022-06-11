<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'inline-flex items-center py-2 pt-1 pl-4 mb-4 border-l-4 border-r-4 border-green-sheen rounded text-sm font-medium text-gray-700 bg-green-500 focus:outline-none focus:text-grey-800 focus:bg-green-100 focus:border-green-700 transition'
                    : 'inline-flex items-center py-2 pt-1 pl-4 mb-4 border-l-4 border-r-4 border-transparent rounded text-sm font-medium  text-gray-500 hover:text-gray-700 hover:border-steel-teal focus:outline-none focus:text-gray-700 focus:border-steel-teal transition'
            }
        }
    })
</script>
