<template>
    <button :type="type" class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-purple-500 focus:outline-none focus:border-purple-700 focus:shadow-outline-purple active:bg-purple-600 transition ease-in-out duration-150" @click="visit">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
            href: {},
        },
        methods: {
            visit(event) {
                if (!this.href) {
                    return
                }
                event.preventDefault()
                this.$inertia.visit(this.href)
            }
        }
    }
</script>