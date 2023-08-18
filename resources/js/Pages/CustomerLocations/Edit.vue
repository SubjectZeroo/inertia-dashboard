<script setup>
import { ref, watch, onMounted, reactive } from "vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import VueMultiselect from "vue-multiselect";
import {
    TableCellsIcon,
    ChevronRightIcon,

} from "@heroicons/vue/24/outline";
const props = defineProps({
    customerLocation: {
        type: Object,
        required: true,
    },
    customers: {
        type: Array,
        required: true,
    },
    // states: {
    //     type: Array,
    //     required: true,
    // },
    countries: {
        type: Array,
        required: true,
    },
});
// const data = reactive({
//     selectedCustomer: {
//         id: props.customerLocation.data.customer.id,
//         name: props.customerLocation.data.customer.id,
//     },
// });

// const loading = ref(false);

// const getCustomerSelect = (value) => {
//     loading.value = true;
//     data.selectedCustomer = value;
//     loading.value = false;
//     console.log(data.selectedCustomer);
// };
// const selectedCustomer= ref(null)
// const selectedId = ref(null)

// const updateCustomer = (selectedCustomer) => {
//     let selectId = null;

//     console.log(selectedCustomer);
// }

const form = useForm({
    // _method: "PUT",
    customer_id: null,
    country_id: null,
    state_id: null,
    name: props.customerLocation.data.name,
    phone: props.customerLocation.data.phone,
    address: props.customerLocation.data.address,
    ubication: props.customerLocation.data.ubication,

});

const submit = () => {
    form
        .transform((data) => ({
            ...data,
            customer_id: data.customer_id.id,
            state_id: data.state_id.id
        }))
        .put(
            route("customer-locations.update", props.customerLocation.data.id)
        );
};

const states = ref([]);

const getEstados = async () => {
    await axios
        .get("/get-states-by-country", {
            params: {
                country_id: form.country_id,
            },
        })
        .then((response) => {
            states.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

onMounted(() => {
    form.customer_id = props.customerLocation?.data.customer;
    form.country_id = props.customerLocation?.data.state.country;
    form.state_id = props.customerLocation?.data.state;
});
watch(
    getEstados,
    () => props.customerLocation,
    () => (form.customer_id = props.customerLocation?.data.customer),
    () => (form.country_id = props.customerLocation?.data.state.country),
    () => (form.state_id = props.customerLocation?.data.state)
);
</script>

<template>
    <AppLayout :title="form.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajustes de Locacion del Cliente
            </h2>
        </template>

        <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <Link href="/customer-locations"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <TableCellsIcon class="w-5 h-5 text-gray-400 mr-2.5" />
                            Locaciones de Cliente
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Editar Locacion de Cliente</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Ajustes Locacion del Cliente
                </h1>
            </div>
            <div class="col-span-2">
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">
                        Información General
                    </h3>
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Cliente" :error="form.errors.customer_id">
                                    <VueMultiselect v-model="form.customer_id" :options="customers.data" :searchable="true"
                                        :close-on-select="true" :show-labels="false" placeholder="Elige un Cliente"
                                        label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Pais" :error="form.errors.country_id">
                                    <VueMultiselect v-model="form.country_id" :options="countries.data" :searchable="true"
                                        :show-labels="false" :close-on-select="true" placeholder="Elige un Pais"
                                        label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Estado" :error="form.errors.state_id">
                                    <VueMultiselect v-model="form.state_id" :options="states" :close-on-select="true"
                                        placeholder="Elige un Estado" label="name" track-by="id"
                                        :disabled="!form.country_id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Nombre" :error="form.errors.name">
                                    <Input v-model="form.name" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Telefono" :error="form.errors.phone">
                                    <Input v-model="form.phone" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Telefono" :error="form.errors.address">
                                    <Input v-model="form.address" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Telefono" :error="form.errors.ubication">
                                    <Input v-model="form.ubication" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-full">
                                <LoadingButton :loading="form.processing"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Guardar
                                </LoadingButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
