<script setup>
import { Link, Head, useForm } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import VueMultiselect from "vue-multiselect";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
const props = defineProps({
  roles: Array,
  permissions: Array,
});

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
  roles: [],
  permissions: [],
});

const submit = () => {
  form.post(route("users.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};

</script>

<template>
  <AppLayout title="Crear Usuario">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Usuario</h2>
    </template>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
      <div class="mb-4 col-span-full xl:mb-2">
        <nav class="flex mb-5" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
            <li class="inline-flex items-center">
              <Link
                href="/users"
                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
              >
                <svg
                  class="w-5 h-5 mr-2.5"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5"
                  />
                </svg>

                Usuarios
              </Link>
            </li>

            <li>
              <div class="flex items-center">
                <svg
                  class="w-6 h-6 text-gray-400"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                <span
                  class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                  aria-current="page"
                  >Crear</span
                >
              </div>
            </li>
          </ol>
        </nav>
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
          Crear Usuario
        </h1>
      </div>
      <div class="col-span-2">
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">Información General</h3>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-6 gap-6">
              <Field label="Nombre" :error="form.errors.name">
                <Input v-model="form.name" type="text" />
              </Field>
              <Field label="Email" :error="form.errors.email">
                <Input v-model="form.email" type="text" />
              </Field>
              <Field label="Password" :error="form.errors.password">
                <Input v-model="form.password" type="text" />
              </Field>
              <Field
                label="Confirmar Password"
                :error="form.errors.password_confirmation"
              >
                <Input v-model="form.password_confirmation" type="text" />
              </Field>
              <Field label="Seleccionar Roles" :error="form.errors.password_confirmation">
                <VueMultiselect
                  v-model="form.roles"
                  :options="roles.data"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Elige los Roles"
                  label="name"
                  track-by="id"
                />
              </Field>
              <Field
                label="Seleccionar Permisos"
                :error="form.errors.password_confirmation"
              >
                <VueMultiselect
                  v-model="form.permissions"
                  :options="permissions.data"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Elige los Permisos"
                  label="name"
                  track-by="id"
                />
              </Field>
              <div class="col-span-6 sm:col-full">
                <LoadingButton
                  :loading="form.processing"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
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
