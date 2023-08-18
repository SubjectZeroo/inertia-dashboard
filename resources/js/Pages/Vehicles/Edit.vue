<script setup>
import { ref, watchEffect, watch, onMounted } from "vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import VueMultiselect from "vue-multiselect";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import {
    TableCellsIcon,
    ChevronRightIcon,

} from "@heroicons/vue/24/outline";
const props = defineProps({
    vehicle: Object,
    customers: Array,
    vehicle_brands: Array,
});
const form = useForm({
    unit: props.vehicle.data.unit,
    serial: props.vehicle.data.serial,
    price: props.vehicle.data.price,
    customer_id: null,
    vehicle_model_id: null,
    vehicle_brand_id: null,
});
const vehicle_models = ref([]);
const getVehicleModels = async () => {

    axios
        .get('/get-vehicle-models-by-vehicle-brand', {
            params: {
                vehicle_brand_id: form.vehicle_brand_id
            }
        })
        .then((response) => {
            vehicle_models.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    form.customer_id = props.vehicle?.data.customer;
    form.vehicle_brand_id = props.vehicle?.data.vehicle_model.vehicle_brand;
    form.vehicle_model_id = props.vehicle?.data.vehicle_model;
});
watch(
    getVehicleModels,
    () => props.vehicle,
    () => (form.customer_id = props.vehicle?.data.customer),
    () => (form.vehicle_brand_id = props.vehicle?.data.vehicle_model.vehicle_brand),
    () => (form.vehicle_model_id = props.vehicle?.data.vehicle_model)
);



const submit = () => {
    form
        .transform((data) => ({
            ...data,
            customer_id: data.customer_id.id,
            vehicle_model_id: data.vehicle_model_id.id
        }))
        .put(
            route("vehicles.update", props.vehicle.data.id)
        );
};
</script>

<template>
    <AppLayout title="Editar Vehiculo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Vehiculo</h2>
        </template>

        <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <Link href="/vehicles"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <TableCellsIcon class="w-5 h-5 mr-2.5" />
                            Vehiculos
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Editar Vehiculo</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Editar Vehiculo
                </h1>
            </div>
            <div class="col-span-2">
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Información General</h3>
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Cliente" :error="form.errors.customer_id">
                                    <VueMultiselect v-model="form.customer_id" :options="customers.data"
                                        :close-on-select="true" placeholder="Elige un Cliente" label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Marca" :error="form.errors.vehicle_brand_id">
                                    <VueMultiselect v-model="form.vehicle_brand_id" :options="vehicle_brands.data"
                                        :close-on-select="true" placeholder="Elige una Marca" label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Modelo" :error="form.errors.vehicle_model_id">
                                    <VueMultiselect v-model="form.vehicle_model_id" :options="vehicle_models"
                                        :close-on-select="true" placeholder="Elige un Modelo" label="name" track-by="id"
                                        :disabled="!form.vehicle_brand_id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Unidad" :error="form.errors.unit">
                                    <Input v-model="form.unit" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Serial" :error="form.errors.serial">
                                    <Input v-model="form.serial" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Precio" :error="form.errors.price">
                                    <Input v-model="form.price" type="text" />
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
