<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-2xl font-bold text-steel-teal box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                <slot name="title"></slot>
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                <slot name="description"></slot>
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside"></slot>
        </div>
    </div>
</template>

<style lang="css" scoped>
.customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>
