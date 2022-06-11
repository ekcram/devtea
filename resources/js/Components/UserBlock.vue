<template>
   <div class="flex flex-wrap">
            <div
                class="flex flex-col w-1/2 p-2"
                v-for="(item, index) in items"
                :key="index"
            >

            <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md p-2">
                <div class="flex flex-col items-center pb-10">
                    <img class="mb-3 w-24 h-24 rounded-full shadow-lg" :src="item.profile_photo_url" :alt="item.username" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{item.username}}</h5>
                    <span class="text-sm text-center text-gray-500 dark:text-gray-400">{{item.bio}}</span>
                    <div class="flex mt-4 space-x-3 lg:mt-6">
                        <a :href="route('profiles.show', item.username)" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">Ver perfil</a>
                    </div>
                </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    props: ['items']
};
</script>

<style lang="scss" scoped>

</style>