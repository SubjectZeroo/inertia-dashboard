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
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import Table from "@/Components/Table.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableRow from "@/Components/TableRow.vue";
import {
    TableCellsIcon,
    ChevronRightIcon,

} from "@heroicons/vue/24/outline";
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
    form.delete(route("roles.permissions.destroy", [props.role.data.id, permissionARevoke.value]), {
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
                            <Link href="/roles"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <TableCellsIcon class="w-5 h-5 text-gray-400 mr-2.5" />

                            Roles
                            </Link>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Editar
                                    Rol</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    Ajustes de Rol
                </h1>
            </div>
            <div class="col-span-3">
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Información General</h3>
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- <div class="col-span-6 sm:col-span-3">
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
              </div> -->
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Nombre" :error="form.errors.name">
                                    <Input v-model="form.name" type="text" />
                                </Field>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <Field label="Seleccionar Permisos" :error="form.errors.password_confirmation">
                                    <VueMultiselect v-model="form.permissions" :options="permissions.data" :multiple="true"
                                        :close-on-select="true" placeholder="Elige uno" label="name" track-by="id" />
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
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Permisos asignados</h3>
                    <!-- <table
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
          </table> -->
                    <Table>
                        <template #header>
                            <TableRow>
                                <TableHeaderCell>Nombre</TableHeaderCell>
                                <TableHeaderCell>Acciones</TableHeaderCell>
                            </TableRow>
                        </template>
                        <template #default>
                            <TableRow v-for="rolePermission in role.data.permissions" :key="rolePermission.id">
                                <TableDataCell class="flex items-center">
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ rolePermission.name }}
                                    </div>
                                </TableDataCell>
                                <TableDataCell>
                                    <a @click="confirmPermissionToRevoke(rolePermission)" id="revokePermissionButton"
                                        tabindex="-1" data-drawer-target="drawer-revoke-permission-default"
                                        data-drawer-show="drawer-revoke-permission-default"
                                        aria-controls="drawer-revoke-permission-default" data-drawer-placement="right"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 cursor-pointer">
                                        <TrashIcon class="w-4 h-4 mr-2" />
                                        Eliminar
                                    </a>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
        <!-- Delete Permission Confirmation Modal -->
        <DialogConfirmation :show="confirmingPermissionToRevoke" @close="closeModal">
            <template #title> Revocar Permiso </template>

            <template #content>
                ¿Estás seguro de que quieres revocar este permiso? Una vez se revoque el permiso, no se mostraran los
                elementos asociados al mismo.
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="revokePermission()">
                    Eliminar Permiso
                </DangerButton>
            </template>
        </DialogConfirmation>
    </AppLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
