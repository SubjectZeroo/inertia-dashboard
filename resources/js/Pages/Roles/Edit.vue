<script setup>
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";


import LoadingButton from "@/Components/LoadingButton.vue";
import DialogConfirmation from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { onMounted, ref, watch } from "vue";
import VueMultiselect from "vue-multiselect";
const props = defineProps({
  role: {
    type: Object,
    required: true,
  },
  permissions: Array,
});
const form = useForm({
  _method: "PUT",
  name: props.role.data.name,
  permissions: [],
});

const submit = () => {
  form.post(route("roles.update", props.role.data.id));
};

onMounted(() => {
    form.permissions = props.role?.data.permissions;
});

watch(
    () => props.role,
    () => (form.permissions = props.role?.data.permissions)
)

const closeModal = () => {
    confirmingPermissionToRevoke.value = false;
};

const confirmingPermissionToRevoke = ref(false);
const permissionARevoke = ref("");
// const form = useForm({});
const confirmPermissionToRevoke = (rolePermission) => {
    confirmingPermissionToRevoke.value = true;
    permissionARevoke.value = rolePermission.id;
};

const revokePermission = () => {
  form.delete(route("roles.permissions.destroy", [props.role.data.id ,permissionARevoke.value]), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    // onError: () => passwordInput.value.focus(),
    // onFinish: () => form.reset(),
  });
};




</script>

<template>
  <AppLayout :title="form.name">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ajustes de rol</h2>
    </template>

    <div class="grid grid-cols-1 px-4 pt-6  xl:gap-4 dark:bg-gray-900">
      <div class="mb-4 col-span-full xl:mb-2">
        <nav class="flex mb-5" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
            <li class="inline-flex items-center">
              <Link
                href="/roles"
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

                Roles
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
                  >Editar</span
                >
              </div>
            </li>
          </ol>
        </nav>
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
          Ajustes de rol
        </h1>
      </div>
      <div class="col-span-3">
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">Información General</h3>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <InputLabel
                  for="name"
                  value="Nombre"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                />
                <TextInput
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  :class="form.errors.name ? 'dark:border-red-500 border-red-500' : ''"
                  autofocus
                  autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="col-span-6 sm:col-span-3">
                <InputLabel
                  for="permissions"
                  value="Permisos"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                />
                <VueMultiselect
                  v-model="form.permissions"
                  :options="permissions.data"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Elige uno"
                  label="name"
                  track-by="id"
                />
              </div>
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
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">Permisos asignados</h3>
          <table
            class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600"
          >
            <thead class="bg-gray-100 dark:bg-gray-700">
              <tr>
                <th
                  scope="col"
                  class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
                >
                  NOMBRE
                </th>
                <th
                  scope="col"
                  class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
                >
                  ACCIONES
                </th>
              </tr>
            </thead>
            <tbody
              class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
            >
              <tr
                v-for="rolePermission in role.data.permissions"
                :key="rolePermission.id"
                class="hover:bg-gray-100 dark:hover:bg-gray-700"
              >
                <td
                  class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                >
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ rolePermission.name }}
                  </div>
                </td>
                <td class="p-4 space-x-2 whitespace-nowrap">
                  <a
                   @click="confirmPermissionToRevoke(rolePermission)"
                    id="revokePermissionButton"
                    tabindex="-1"
                    data-drawer-target="drawer-delete-user-default"
                    data-drawer-show="drawer-delete-user-default"
                    aria-controls="drawer-delete-user-default"
                    data-drawer-placement="right"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 cursor-pointer"
                  >
                    <svg
                      class="w-4 h-4 mr-2"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                    Revocar
                  </a>
                </td>
              </tr>
              <tr v-if="role.data.permissions.length === 0">
                <td class="px-6 py-4 border-t dark:text-gray-400" colspan="4">
                  No se encontraron permisos asignados para este rol.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Delete Permission Confirmation Modal -->
    <DialogConfirmation :show="confirmingPermissionToRevoke" @close="closeModal">
        <template #title> Revocar Permiso </template>

        <template #content>
            ¿Estás seguro de que quieres revocar este permiso? Una vez se revoque el permiso, no se mostraran los elementos asociados al mismo.
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

            <DangerButton
            class="ml-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="revokePermission()"
            >
            Eliminar Permiso
            </DangerButton>
        </template>
     </DialogConfirmation>
  </AppLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
