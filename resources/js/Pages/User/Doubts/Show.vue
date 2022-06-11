<template>
    <Head :title="'DevTalk / ' + `${doubt.name}` + ' - DevTea'" />
    <pages-layout>
            <div class="flex flex-col">
                <inertia-link :href="route('doubts.index')" class="flex text-gray-800">
                   <icon name="angle-left" class="w-3 h-3 fill-current"></icon>
                   <span class="font-light text-lg ml-2">Volver</span>
                </inertia-link>
                <div class="flex justify-between items-center mt-5">
                    <h3 class="font-normal text-xl text-midnight-green leading-normal">
                        {{ doubt.name}}
                    </h3>

                    <!-- Botón switch-->
                    <form @submit.prevent="updateResolved">
                        <div class="flex items-end justify-end mb-16">
                            
                            <template v-if="doubt.is_resolved === 0">
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" v-model="doubt.is_resolved" @click="updateResolved" />
                                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div> 
                            </template>

                            <template v-else>
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" checked disabled />
                                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </template>

                            <span v-if="doubt.is_resolved === 0" class="text-xs font-semibold inline-block py-1 px-2 rounded r ext-rose-600 bg-rose-200  last:mr-0 mr-1">
                                Sin resolver
                            </span>
                            <span v-else class="text-xs font-semibold inline-block py-1 px-2 rounded t text-emerald-600 bg-emerald-200 last:mr-0 mr-1">
                                Resuelto
                            </span>

                        </div>
                    </form>
                </div>
                <div class="flex mt-5 h-full">
                    <div class="flex-1 rounded-md border boder-gray-300 flex flex-col h-128">
                        <doubt-box :messages="messages"></doubt-box>
                        <doubt-input :method="enviarMensaje" :form="form" :item="doubt"></doubt-input>
                    </div>
                </div>
            </div>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from '@/Layouts/PagesLayout';
import DoubtBox from '@/Components/Doubt/DoubtBox';
import DoubtInput from '@/Components/Doubt/DoubtInput';

export default {
    props:['doubt', 'messages'],
    components:{
        Head,
        PagesLayout,
        DoubtBox,
        DoubtInput,
    },
    mounted(){
        this.connect()
    },
    data() {
        return {
            form: this.$inertia.form({
                content: this.content,
                doubt: this.doubt
            }),
            formResolved: this.$inertia.form({
                is_resolved: this.doubt.is_resolved,
                slug: this.doubt.slug
            }),
        };
    },
    methods: {
        connect() {
            Echo.private(`doubt.${this.doubt.id}`)
            .listen('NewDoubtMessageEvent', (e) => {
                console.log(e);
               let newMessage = {
                     content: e.message.content,
                        user: e.user,
               }
               this.messages.push(newMessage)
            })
        },
        enviarMensaje() {
            this.form.post(this.route('doubts.store', this.doubt),{
                preserveScroll: true,
                onSuccess:()=> {
                    this.form.content = null
                }
            })
        },
        updateResolved(){
           this.doubt.is_resolved = true
           this.formResolved.patch(this.route('doubts.update', this.doubt.slug), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Has marcado el tema como resuelto.",
                    })
                },
            })
        }
    }
};
</script>

<style lang="css" scoped>
/* input:checked~.dot {
  transform: translateX(100%);
  background-color: #48bb78;
} */

.toggle-checkbox:checked {
  @apply: right-0 border-green-400;
  right: 0;
  border-color: #68D391;
}
.toggle-checkbox:checked + .toggle-label {
  @apply: bg-green-400;
  background-color: #68D391;
}
</style>