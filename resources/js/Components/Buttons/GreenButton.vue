<template>
    <button :type="type" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-white tracking-widest focus:outline-none transition ease-in-out duration-150" @click="visit">
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

<style lang="css" scoped>
    button:hover {
        background-color: #A7D7C5;
    }
    button{
        background-color: #5C8D89;
    }
</style>