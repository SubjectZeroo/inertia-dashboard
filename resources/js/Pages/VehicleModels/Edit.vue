<script setup>
import { ref, watchEffect, watch, onMounted } from "vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import VueMultiselect from "vue-multiselect";
import {
    TableCellsIcon,
    ChevronRightIcon,

} from "@heroicons/vue/24/outline";
const props = defineProps({
    vehicleModel: Object,
    vehicle_brands: Array,
    vehicle_types: Array,
});
const form = useForm({
    name: props.vehicleModel.data.name,
    vehicle_brand_id: null,
    vehicle_type_id: null,
});

onMounted(() => {
    form.vehicle_brand_id = props.vehicleModel?.data.vehicle_brand;
    form.vehicle_type_id = props.vehicleModel?.data.vehicle_type;
});
watch(
    () => props.vehicleModel,
    () => (form.vehicle_brand_id = props.vehicleModel?.data.vehicle_brand),
    () => (form.vehicle_type_id = props.vehicleModel?.data.vehicle_type),
);


const submit = () => {
    form
        .transform((data) => ({
            ...data,
            vehicle_brand_id: data.vehicle_brand_id.id,
            vehicle_type_id: data.vehicle_type_id.id
        }))
        .put(
            route("vehicle-models.update", props.vehicleModel.data.id)
        );
};
</script>

<template>
    <AppLayout title="Editar Modelo de Vehiculo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Modelo de Vehiculo</h2>
        </template>

        <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <Link href="/vehicle-models"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <TableCellsIcon class="w-5 h-5 mr-2.5" />

                            Modelos de Vehiculo
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Editar Modelo de Vehiculo</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Editar Modelo de Vehiculo
                </h1>
            </div>
            <div class="col-span-2">
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Información General</h3>
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Nombre" :error="form.errors.name">
                                    <Input v-model="form.name" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Tipo Maquinaria" :error="form.errors.vehicle_type_id">
                                    <VueMultiselect v-model="form.vehicle_type_id" :options="vehicle_types.data"
                                        :multiple="false" :close-on-select="true" placeholder="Elige uno" label="name"
                                        track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Modelo Maquinaria" :error="form.errors.vehicle_brand_id">
                                    <VueMultiselect v-model="form.vehicle_brand_id" :options="vehicle_brands.data"
                                        :multiple="false" :close-on-select="true" placeholder="Elige uno" label="name"
                                        track-by="id" />
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
