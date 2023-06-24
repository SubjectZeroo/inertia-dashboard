<script setup>
import { onMounted, ref, watch } from "vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import VueMultiselect from "vue-multiselect";
import DialogConfirmation from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import Table from "@/Components/Table.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableRow from "@/Components/TableRow.vue";
import {

  ChevronRightIcon,
 TableCellsIcon
} from "@heroicons/vue/24/outline";
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  roles: Array,
  permissions: Array,
});
const form = useForm({
  _method: "PUT",
  name: props.user.data.name,
  email: props.user.data.email,
  profile_photo_url: props.user.data.profile_photo_url,
  roles: [],
  permissions: [],
});

const submit = () => {
  form.post(route("users.update", props.user.data.id));
};

onMounted(() => {
  form.permissions = props.user?.data.permissions;
  form.roles = props.user?.data.roles;
});

watch(
  () => props.user,
  () => {
    (form.permissions = props.user?.data.permissions),
      (form.roles = props.user?.data.permissions);
  }
);

const closeModal = () => {
  confirmingPermissionToRevoke.value = false;
  confirmingRoleToRemove.value = false;
};

const confirmingPermissionToRevoke = ref(false);
const permissionARevoke = ref("");
const confirmPermissionToRevoke = (permission) => {
  confirmingPermissionToRevoke.value = true;
  permissionARevoke.value = permission.id;
};

const revokePermission = () => {
  form.delete(
    route("users.permissions.destroy", [props.user.data.id, permissionARevoke.value]),
    {
      preserveScroll: true,
      onSuccess: () => closeModal(),
      // onError: () => passwordInput.value.focus(),
      // onFinish: () => form.reset(),
    }
  );
};

const confirmingRoleToRemove = ref(false);
const roleARemove = ref("");
const confirmRoleToRemove = (userRole) => {
  confirmingRoleToRemove.value = true;
  roleARemove.value = userRole.id;
};

const removeRole = () => {
  form.delete(route("users.role.destroy", [props.user.data.id, roleARemove.value]), {
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
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ajustes de usuario
      </h2>
    </template>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
      <div class="mb-4 col-span-full xl:mb-2">
        <nav class="flex mb-5" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
            <li class="inline-flex items-center">
              <Link
                href="/users"
                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
              >
                <TableCellsIcon   class="w-5 h-5 mr-2.5"/>
                Usuarios
              </Link>
            </li>
            <li>
              <div class="flex items-center">

                <ChevronRightIcon class="w-5 h-5 text-gray-400"/>
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
          Ajustes de usuario
        </h1>
      </div>
      <div class="col-span-full xl:col-auto">
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <div
            class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4"
          >
            <img
              class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
              :src="form.profile_photo_url"
              :alt="form.name"
            />
            <div>
              <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">
                {{ form.name }}
              </h3>
            </div>
          </div>
        </div>
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
          <h3 class="mb-4 text-xl font-semibold dark:text-white">
            Información de contraseña
          </h3>
          <form action="#" data-bitwarden-watching="1">
            <div class="grid grid-cols-6 gap-6">
              <Field label="Password" :error="form.errors.password">
                <Input v-model="form.password" type="text" />
              </Field>
              <Field
                label="Confirmar Password"
                :error="form.errors.password_confirmation"
              >
                <Input v-model="form.password_confirmation" type="text" />
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
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">Roles asignados</h3>
          <Table>
            <template #header>
              <TableRow>
                <TableHeaderCell>Nombre</TableHeaderCell>
                <TableHeaderCell>Acciones</TableHeaderCell>
              </TableRow>
            </template>
            <template #default>
              <TableRow v-for="userRole in user.data.roles" :key="userRole.id">
                <TableDataCell class="flex items-center">
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ userRole.name }}
                  </div>
                </TableDataCell>
                <TableDataCell>
                  <a
                    @click="confirmRoleToRemove(userRole)"
                    id="revokePermissionButton"
                    tabindex="-1"
                    data-drawer-target="drawer-revoke-permission-default"
                    data-drawer-show="drawer-revoke-permission-default"
                    aria-controls="drawer-revoke-permission-default"
                    data-drawer-placement="right"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 cursor-pointer"
                  >
                    <TrashIcon class="w-4 h-4 mr-2" />
                    Eliminar
                  </a>
                </TableDataCell>
              </TableRow>
            </template>
          </Table>
        </div>
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">Permisos asignados</h3>
          <Table>
            <template #header>
              <TableRow>
                <TableHeaderCell>Nombre</TableHeaderCell>
                <TableHeaderCell>Acciones</TableHeaderCell>
              </TableRow>
            </template>
            <template #default>
              <TableRow
                v-for="userPermission in user.data.permissions"
                :key="userPermission.id"
              >
                <TableDataCell class="flex items-center">
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ userPermission.name }}
                  </div>
                </TableDataCell>
                <TableDataCell>
                  <a
                    @click="confirmPermissionToRevoke(userPermission)"
                    id="revokePermissionButton"
                    tabindex="-1"
                    data-drawer-target="drawer-revoke-permission-default"
                    data-drawer-show="drawer-revoke-permission-default"
                    aria-controls="drawer-revoke-permission-default"
                    data-drawer-placement="right"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 cursor-pointer"
                  >
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
    <!-- Revoke Permission Confirmation Modal -->
    <DialogConfirmation :show="confirmingPermissionToRevoke" @close="closeModal">
      <template #title> Revocar Permiso </template>

      <template #content> ¿Estás seguro de que quieres revocar este Permiso? </template>

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
    <!-- Revoke Role Confirmation Modal -->
    <DialogConfirmation :show="confirmingRoleToRemove" @close="closeModal">
      <template #title> Revocar Rol </template>

      <template #content> ¿Estás seguro de que quieres revocar este Rol? </template>

      <template #footer>
        <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

        <DangerButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="removeRole()"
        >
          Eliminar Rol
        </DangerButton>
      </template>
    </DialogConfirmation>
  </AppLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
