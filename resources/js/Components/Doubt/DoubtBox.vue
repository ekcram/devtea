<template>
 <div class="h-full overflow-y-auto">
       <div v-for="message in messages" :key="message.id" 
            :class="message.user.id != $page.props.user.id ? 'text-right' : 'text-left' " class="px-4 py-4">
            <div :class="message.user.id != $page.props.user.id ? 'justify-end' : ' '" class="flex items-center">
                <img :src="message.user.profile_photo_url" class="w-7 h-7 rounded-full object-cover" :alt="message.user.username">
                <inertia-link :href="(route('profiles.show', message.user.username))">
                    <span class="font-semibold tracking-wider ml-1" :class="message.user.id != $page.props.user.id ? 'text-regal-blue' : 'text-regal-blue'">
                        {{ message.user.username }}
                    </span>
                </inertia-link>
            </div>
            <div class="flex flex-col">
                <div class="mt-3 mb-2">
                     <span class="text-sm p-2 m-2 px-2 w-full rounded" 
                     :class="message.user.id != $page.props.user.id ? 'text-right bg-gray-200 text-gray-800 rounded-br-none' : 'text-left bg-orange-400 text-white rounded-bl-none' ">{{message.content}}</span>
                </div>
               
                <span class="text-xs italic">{{ $filters.timeAgo(message.created_at)}}</span>
            </div>
        </div>
   </div>   
</template>

<script>
export default {
    props:[
        'messages'
    ],
    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>

</style>