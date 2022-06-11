<template>
<Head title="Membership Checkout - DevTea" />
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row justify-between">
                <div class="text-4xl font-extrabold leading-none tracking-tight font-inter">
                    <span class="box-decoration-slice rounded text-white customSpan leading-[3.5rem] px-2">
                        Membresía
                    </span>
                </div>
                 <div class="items-end">
                    <inertia-link :href="route('subscription.index')" class="flex text-gray-800">
                        <icon name="angle-left" class="w-3 h-3 fill-current"></icon>
                        <span class="font-light text-lg ml-2">Volver</span>
                    </inertia-link>
                </div>
            </div>
            <div class="flex py-9">
                <div class="relative mx-auto max-w-screen-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- INFORMACIÓN DEL PAGO Y SUBSCRIPCIÓN -->
                        <div class="py-12 bg-gray-50 md:py-24">
                            <div class="max-w-lg px-4 mx-auto lg:px-8">
                                <div class="flex items-center">
                                    <span class="w-10 h-10 bg-blue-900 rounded-full"></span>
                                    <h2 class="ml-4 font-medium">DevTea</h2>
                                </div>
                                <div class="mt-8">
                                    <p class="text-2xl font-medium tracking-tight">5€/mes </p>
                                    <p class="mt-1 text-xl text-gray-500">Subscripción a DevTea Premium</p>
                                </div>
                            </div>
                        </div>

                        <!-- FORMULARIO -->
                        <div class="py-12 bg-white md:py-24">
                            <div class="max-w-lg px-4 mx-auto lg:px-8">
                                <form class="grid grid-cols-6 gap-4" @submit.prevent="submitPayment">
                                    <input type="hidden" name="price" v-model="form.price">
                                    <input type="hidden" name="payment_type" v-model="form.payment_type">
                                    <div class="col-span-6">
                                        <label class="block mb-1 text-sm text-gray-600" for="name">
                                            Nombre completo
                                        </label>
                                        <input class="rounded-lg shadow-sm border-gray-200 w-full text-sm p-2.5" 
                                        type="text" 
                                        name="card_name"
                                        v-model="form.card_name"/>
                                    </div>

                                    <div class="col-span-6">
                                        <label class="block mb-1 text-sm text-gray-600" for="email">
                                            Email
                                        </label>

                                        <input
                                            class="rounded-lg shadow-sm border-gray-200 w-full text-sm p-2.5"
                                            type="email"
                                            name="cus_email"
                                            v-model="form.cus_email"
                                        />
                                    </div>

                                    <div class="col-span-6">
                                        <label class="block mb-1 text-sm text-gray-600" for="phone">
                                            Teléfono
                                        </label>

                                        <input
                                            class="rounded-lg shadow-sm border-gray-200 w-full text-sm p-2.5"
                                            type="tel"
                                            pattern="[0-9]{9}"
                                            id="phone"
                                            name="cus_phone"
                                            v-model="form.cus_phone"
                                        />
                                    </div>

                                    <fieldset class="col-span-6">
                                        <legend class="block mb-1 text-sm text-gray-600">
                                            Detalles de la tarjeta
                                        </legend>

                                        <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                            <div>
                                                <label class="sr-only" for="card-number">Número de tarjeta</label>

                                                <input
                                                    class="border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5 placeholder-gray-400"
                                                    type="number"
                                                    placeholder="Card number"
                                                     pattern="[0-9]{16}"
                                                    v-model="form.card_number"
                                                    name="card_number"
                                                    required
                                                />
                                            </div>

                                            <div class="flex -space-x-px">
                                                <div class="flex-1">
                                                    <label class="sr-only" for="card-expiration-date">
                                                    Fecha de expiración
                                                    </label>

                                                    <input
                                                    class="border-gray-200 relative rounded-bl-lg w-full focus:z-10 text-sm p-2.5 placeholder-gray-400"
                                                    type="text"
                                                    placeholder="MM-YY"
                                                    name="card_expiry"
                                                    v-model="form.card_expiry"
                                                    />
                                                </div>

                                                <div class="flex-1">
                                                    <label class="sr-only" for="card-cvc">CVC</label>

                                                    <input
                                                    class="border-gray-200 relative rounded-br-lg w-full focus:z-10 text-sm p-2.5 placeholder-gray-400"
                                                    type="number"
                                                    placeholder="CVC"
                                                    pattern="[0-9]{3}"
                                                    name="card_cvc"
                                                    v-model="form.card_cvc"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="col-span-6">
                                        <legend class="block mb-1 text-sm text-gray-600">
                                            Dirección de facturación
                                        </legend>

                                        <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                            <div>
                                                <label class="sr-only" for="country">País</label>
                                                    <select
                                                        name="cus_country"
                                                        id="country"
                                                        class="border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5"
                                                        v-model="form.cus_country"
                                                    >
                                                    <option v-for="country in countries" :key="country">
                                                        {{ country.country }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="sr-only" for="postal-code">
                                                    Código Postal
                                                </label>

                                                <input
                                                    class="border-gray-200 relative rounded-b-lg w-full focus:z-10 text-sm p-2.5 placeholder-gray-400"
                                                    type="number"
                                                    pattern="[0-9]{5}"
                                                    placeholder="CP"
                                                    name="cus_zipcode"
                                                    v-model="form.cus_zipcode"
                                                />
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="col-span-6">
                                        <green-button type="submit" class="w-full">
                                            <dot-loader v-if="loading" :loading="loading" :color="color" :size="size"></dot-loader>
                                            <span class="ml-2 text-sm">Pagar</span>
                                        </green-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import PagesLayout from "@/Layouts/PagesLayout.vue";
import GreenButton from "@/Components/Buttons/GreenButton.vue";
export default {
    components: {
        Head,
        PagesLayout,
        GreenButton
    },
    props: {
       
    },
     mounted() {
        this.getCountries();
    },
    data() {
        return {
            form: this.$inertia.form({
                'user_id': this.$page.props.user.id,
                'card_number': null,
                'card_name': null,
                'card_expiry': null,
                'card_cvc': null,
                'cus_country': null,
                'cus_email': null,
                'cus_phone': null,
                'cus_zipcode': null,
                'price': 5.00,
                'payment_type': 'subscription' 
            }),
            loading: false,
            color: 'white',
            size: '16',
            countries:[]
        }
    },
    methods: {
        submitPayment(){
             this.loading = true
             this.form.post(route('subscription.store'), {
                preserveScroll: true,
                onSuccess: () => {
                   Toast.fire({
                        icon: "success",
                        title: "Pago realizado con éxito",
                    })
                    this.loading = false
                } 
            });
        },
        getCountries() {
            const url = "https://countriesnow.space/api/v0.1/countries";
            axios.get(url).then((response) => {
                this.countries = response.data.data;
            });
        },
        print() {
            window.print();
        }
       
    },
};
</script>

<style lang="css" scoped>
    .customSpan {
        background-color: #74B49B;
        font-weight: bold;
    }
</style>


