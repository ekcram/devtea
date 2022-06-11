<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title> Perfil </template>

        <template #description>
            Actualiza la información de tu perfil.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                class="col-span-6 sm:col-span-4"
                v-if="$page.props.jetstream.managesProfilePhotos"
            >
                <!-- Profile Photo File Input -->
                <input
                    type="file"
                    class="hidden"
                    ref="photo"
                    @change="updatePhotoPreview"
                />

                <jet-label
                    for="photo"
                    value="Foto de perfil"
                    class="text-steel-teal"
                />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="!photoPreview">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    >
                    </span>
                </div>

                <jet-secondary-button
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Nueva foto de perfil
                </jet-secondary-button>

                <jet-secondary-button
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                    v-if="user.profile_photo_path"
                >
                    Eliminar foto
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

             <!-- Profile Header Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">

                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" ref="headerPhoto" @change="updateHeaderPhotoPreview"/>
                <jet-label for="headerPhoto" value="Foto header de perfil" class="text-steel-teal"/>

                <!-- Current Profile Header Photo -->
                <div class="mt-2" v-show="!headerPhotoPreview">
                    <img :src="user.profile_header_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover"/>
                </div>

                <!-- New Profile Header Photo Preview -->
                <div class="mt-2" v-show="headerPhotoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" :style=" 'background-image: url(\'' + headerPhotoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewHeaderPhoto">
                    Nuevo header
                </jet-secondary-button>

                <jet-secondary-button
                    type="button"
                    class="mt-2"
                    @click.prevent="deleteHeaderPhoto"
                    v-if="user.profile_header_photo_path"
                >
                    Eliminar header
                </jet-secondary-button>

                <jet-input-error :message="form.errors.headerPhoto" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Nombre" class="text-steel-teal" />
                <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autocomplete="name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Apellidos -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="surname"
                    value="Apellidos"
                    class="text-steel-teal"
                />
                <jet-input
                    id="surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.surname"
                    autocomplete="surname"
                />
                <jet-input-error :message="form.errors.surname" class="mt-2" />
            </div>

            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="username"
                    value="Username"
                    class="text-steel-teal"
                />
                <jet-input
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    autocomplete="username"
                />
                <jet-input-error :message="form.errors.username" class="mt-2" />
            </div>

            <!-- Biografía -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="bio"
                    value="Biografía"
                    class="text-steel-teal"
                />
                <textarea
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none mt-1"
                    id="bio"
                    v-model="form.bio"
                    rows="3"
                    placeholder="Cuéntanos algo sobre ti."
                ></textarea>
                <jet-input-error :message="form.errors.bio" class="mt-2" />
            </div>

            <!-- Fecha de nacimiento -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="date_of_birth"
                    value="Fecha de nacimiento"
                    class="text-steel-teal"
                />
                <jet-input
                    id="date_of_birth"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.date_of_birth"
                    autocomplete="date_of_birth"
                />
                <jet-input-error
                    :message="form.errors.date_of_birth"
                    class="mt-2"
                />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" class="text-steel-teal" />
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>

            <!-- Dirección -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="address"
                    value="Dirección"
                    class="text-steel-teal"
                />
                <jet-input
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autocomplete="address"
                    placeholder="Introduce tu dirección"
                />
                <jet-input-error :message="form.errors.address" class="mt-2" />
            </div>

            <!-- País -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="country" value="País" class="text-steel-teal" />
                <select
                    name="country"
                    id="country"
                    class="block focus:border-gray-500 mt-1 w-full"
                    v-model="form.country"
                >
                    <option v-for="country in countries" :key="country">
                        {{ country.country }}
                    </option>
                </select>
                <jet-input-error :message="form.errors.country" class="mt-2" />
            </div>

              <!-- Teléfono -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label
                    for="phone"
                    value="Teléfono (opcional)"
                    class="text-steel-teal"
                />
                <jet-input
                    id="phone"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autocomplete="phone"
                    placeholder="Introduce tu teléfono"
                />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>

            <!-- Género -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="gender" value="Género" class="text-steel-teal" />
                <select
                    name="gender"
                    id="gender"
                    class="block focus:border-gray-500 mt-1 w-full"
                    v-model="form.gender"
                >
                    <option v-for="gender in genders" :key="gender">
                        {{ gender }}
                    </option>
                </select>
                <jet-input-error :message="form.errors.gender" class="mt-2" />
            </div>
        </template>

        <template #actions>

            <jet-button id="submit"
                class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight rounded-full shadow-md  hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Guardar
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ["user",'profile'],

    data() {
        return {
            form: this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                surname: this.user.surname,
                username: this.user.username,
                date_of_birth: this.user.date_of_birth,
                country: this.user.country,
                bio: this.user.bio,
                address: this.user.address,
                phone: this.user.phone,
                email: this.user.email,
                gender: this.user.gender,
                photo: null,
                headerPhoto: null,
            }),
            countries: [],
            isValid: true,
            genders: ['Hombre', 'Mujer', 'No binario'],
            photoPreview: null,
            headerPhotoPreview: null,
        };
    },
    mounted() {
        this.getCountries();
    },
    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            if (this.$refs.headerPhoto) {
                this.form.headerPhoto = this.$refs.headerPhoto.files[0];
            }

            this.form.post(route("user-profile-information.update"), {
                errorBag: "updateProfileInformation",
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Perfil actualizado correctamente.",
                    })
                    this.clearPhotoFileInput()
                    this.clearHeaderPhotoFileInput()
                } 
            });
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },

        selectNewHeaderPhoto() {
            this.$refs.headerPhoto.click();
        },

        updatePhotoPreview() {
            const photo = this.$refs.photo.files[0];

            if (!photo) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(photo);
        },

        updateHeaderPhotoPreview() {
            const photo = this.$refs.headerPhoto.files[0];

            if (!photo) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.headerPhotoPreview = e.target.result;
            };

            reader.readAsDataURL(photo);
        },

        deletePhoto() {
            this.$inertia.delete(route("current-user-photo.destroy"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.photoPreview = null;
                    this.clearPhotoFileInput();
                },
            });
        },

        deleteHeaderPhoto() {
            this.$inertia.delete(route("current-user-header-photo.destroy"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.headerPhotoPreview = null;
                    this.clearHeaderPhotoFileInput();
                },
            });
        },

        clearPhotoFileInput() {
            if (this.$refs.photo?.value) {
                this.$refs.photo.value = null;
            }
        },

        clearHeaderPhotoFileInput() {
            if (this.$refs.headerPhoto?.value) {
                this.$refs.headerPhoto.value = null;
            }
        },

        getCountries() {
            const url = "https://countriesnow.space/api/v0.1/countries";
            axios.get(url).then((response) => {
                this.countries = response.data.data;
            });
        },
    },
});
</script>

<style lang="css" scoped>

.error{
  color:red;
}

</style>
