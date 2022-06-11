<template>
    <div>
        <form
            @submit.prevent="method"
            :class="aplicarAncho"
            enctype="multipart/form-data"
            class="shadow-lg rounded px-3 py-3"
        >
            <div>
                <quill-editor v-model:value="this.form.content" :options="editorOption"></quill-editor>
            </div>

            <div class="flex justify-between my-3">
                <div>
                    <jet-input-error
                        :message="form.errors.content"
                        class="mt-2"
                        v-if="form.errors.content"
                    ></jet-input-error>
                    <jet-input-error
                        :message="form.errors.message"
                        class="mt-2"
                        v-if="form.errors.message"
                    ></jet-input-error>
                </div>

                <div v-if="text === 'Publicar'">
                    <orange-button
                        type="submit"
                        class="text-xs"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <dot-loader
                            v-if="form.processing"
                            :color="color"
                            :size="size"
                        ></dot-loader>
                        <span v-else>{{ text }}</span>
                    </orange-button>
                </div>
                <div v-else>
                    <green-button
                        type="submit"
                        class="text-xs"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <dot-loader
                            v-if="form.processing"
                            :color="color"
                            :size="size"
                        ></dot-loader>
                        <span v-else>{{ text }}</span>
                    </green-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import OrangeButton from "@/Components/Buttons/OrangeButton";
import GreenButton from "@/Components/Buttons/GreenButton";
import JetInputError from "@/Jetstream/InputError";

const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        [{'header': 1}, {'header': 2}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}],
        [{'direction': 'rtl'}],

        [{'size': ['small', false, 'large', 'huge']}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],

        [{'color': []}, {'background': []}],
        [{'font': []}],
        [{'align': []}],
        ['link', 'image', 'video'],
        ['clean'], 
];

export default {
    components: {
        OrangeButton,
        JetInputError,
        GreenButton,
    },
    props: ["form", "method", "text"],
    data() {
        return {
            color: "white",
            size: "16",
            editorOption: {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                    },
                    history: {
                        delay: 1000,
                        maxStack: 50,
                        userOnly: false
                    },
                    imageResize: {
                        displayStyles: {
                            backgroundColor: 'black',
                            border: 'none',
                            color: 'white'
                        },
                        modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                    }
                }
            },
        };
    },
    methods: {
      
    },
    computed: {
        editor(){
            return this.$refs.myQuillEditor.quill
        },
        aplicarAncho() {
            let clase = "w-full";
            if (this.text === "Publicar") {
            } else {
                clase = "w-3/4";
            }
            return clase;
        },
    }
};
</script>
