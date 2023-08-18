<script setup>
import { ref, watchEffect, watch } from "vue";
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
    units: Array,
    item_categories: Array,
    // item_subcategories: Array,
    item_brands: Array,
});

const form = useForm({
    code: "",
    name: "",
    price: "",
    cost: "",
    description: "",
    unit_id: null,
    item_category_id: null,
    //   item_subcategory_id: null,
    item_brand_id: null,
});

const item_subcategories = ref([]);
const getItemSubcategories = async () => {

    axios
        .get('/get-items-subcategories-by-item-categories', {
            params: {
                item_category_id: form.item_category_id
            }
        })
        .then((response) => {
            item_subcategories.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
watch(getItemSubcategories);

const submit = () => {
    form.transform((data) => ({
        ...data,
        unit_id: data.unit_id.id,
        item_category_id: data.item_category_id.id,
        item_brand_id: data.item_brand_id.id
    })).post(route("items.store"));
};
</script>

<template>
    <AppLayout title="Crear Articulo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Articulo</h2>
        </template>

        <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <Link href="/items"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <TableCellsIcon class="w-5 h-5 text-gray-400 mr-2.5" />

                            Articulos
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Crear Articulo</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Crear Articulo
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
                                <Field label="Codigo" :error="form.errors.code">
                                    <Input v-model="form.code" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Unidad" :error="form.errors.unit_id">
                                    <VueMultiselect v-model="form.unit_id" :options="units.data" :close-on-select="true"
                                        placeholder="Elige una unidad" label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Marca" :error="form.errors.item_brand_id">
                                    <VueMultiselect v-model="form.item_brand_id" :options="item_brands.data"
                                        :close-on-select="true" placeholder="Elige una marca" label="name" track-by="id" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Categoria" :error="form.errors.item_category_id">
                                    <VueMultiselect v-model="form.item_category_id" :options="item_categories.data"
                                        :close-on-select="true" placeholder="Elige una categoria" label="name"
                                        track-by="id" />
                                </Field>
                            </div>
                            <!-- <Field label="Seleccionar Subcategoria" :error="form.errors.item_subcategory_id">
                <VueMultiselect
                  v-model="form.item_subcategory_id"
                  :options="item_subcategories"
                  :close-on-select="true"
                  placeholder="Elige una categoria"
                  label="name"
                  track-by="id"
                  :disabled="!form.item_category_id"
                />
              </Field> -->
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Precio" :error="form.errors.price">
                                    <Input v-model="form.price" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Costo" :error="form.errors.cost">
                                    <Input v-model="form.cost" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Descripcion" :error="form.errors.description">
                                    <Input v-model="form.description" type="text" />
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
