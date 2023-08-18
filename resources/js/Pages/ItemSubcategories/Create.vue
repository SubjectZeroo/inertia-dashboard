<script setup>
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import LoadingButton from '@/Components/LoadingButton.vue';
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import VueMultiselect from "vue-multiselect";
import {
    TableCellsIcon,
    ChevronRightIcon,

} from "@heroicons/vue/24/outline";

const props = defineProps({
    item_categories: Array,
});

const form = useForm({
    name: "",
    item_category_id: null
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        item_category_id: data.item_category_id.id,
    })).post(route("item-subcategories.store"));
};
</script>

<template>
    <AppLayout title="Crear Subcategoria de Articulo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Subcategoria de Articulo</h2>
        </template>

        <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <Link href="/item-subcategories"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <TableCellsIcon class="w-5 h-5 text-gray-400 mr-2.5" />

                            Subcategorias de Articulo
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Crear Subcategoria de Articulo</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Crear Subcategoria de Articulo
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
                                <Field label="Seleccionar Tipo Categoria" :error="form.errors.item_category_id">
                                    <VueMultiselect v-model="form.item_category_id" :options="item_categories.data"
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
