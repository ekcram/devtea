<template>
    <app-layout>
        <div class="lg:px-10">
            <div>
                <!-- Slot nos permite añadir un título dinámicamente en cada página donde pongamos este layout-->
                <slot name="title"></slot>
            </div>
            <div class="mt-5">
                <slot></slot>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './AppLayout.vue';
export default {
    components:{
        AppLayout
    }
  
};
</script>

<style lang="scss" scoped>

</style>