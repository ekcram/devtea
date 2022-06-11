<template>
     <button :type="type" class="inline flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest 
      focus:outline-none transition ease-in-out duration-150">
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
        },
    }
</script>

<style lang="css" scoped>
    button:hover {
        background-color: #e78685;
    }
    button{
        background-color: #E94A47;
    }
</style>