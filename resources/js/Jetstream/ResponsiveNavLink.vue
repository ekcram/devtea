<template>
    <div>
        <button :class="classes" class="w-full text-left" v-if="as == 'button'">
            <slot></slot>
        </button>

        <Link v-else :href="href" :class="classes" >
            <slot />
        </Link>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['active', 'href', 'as'],

        computed: {
            classes() {
                return this.active
                    ? 'block pl-3 pr-4 py-2 border-l-4 border-green-sheen text-base font-medium text-gray-700 bg-green-50 focus:outline-none focus:text-grey-800 focus:bg-green-100 focus:border-green-700 transition'
                    : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-green-800 focus:bg-gray-50 focus:border-gray-300 transition'
            }
        }
    })
</script>
