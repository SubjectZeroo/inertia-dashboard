<script setup>
import { onMounted, ref, watch } from "vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import VueMultiselect from "vue-multiselect";
import DialogConfirmation from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  roles: Array,
  permissions: Array
});
const form = useForm({
  _method: "PUT",
  name: props.user.data.name,
  email: props.user.data.email,
  profile_photo_url: props.user.data.profile_photo_url,
  roles:[],
  permissions:[]
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
        form.permissions = props.user?.data.permissions,
        form.roles = props.user?.data.permissions
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
  form.delete(route("users.permissions.destroy", [props.user.data.id ,permissionARevoke.value]), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    // onError: () => passwordInput.value.focus(),
    // onFinish: () => form.reset(),
  });
};



const confirmingRoleToRemove = ref(false);
const roleARemove = ref("");
const confirmRoleToRemove = (userRole) => {
    confirmingRoleToRemove.value = true;
    roleARemove.value = userRole.id;
};

const removeRole = () => {
  form.delete(route("users.role.destroy", [props.user.data.id ,roleARemove.value]), {
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
              <div class="col-span-6 sm:col-span-3">
                <InputLabel for="name" value="Nombre"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :class="form.errors.name ? 'dark:border-red-500 border-red-500': ''"
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="col-span-6 sm:col-span-3">
                <InputLabel for="email" value="Email"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :class="form.errors.email ? 'dark:border-red-500 border-red-500': ''"
                />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
              <div class="col-span-6 sm:col-span-3">
                <InputLabel
                  for="roles"
                  value="Roles"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                />
                <VueMultiselect
                  v-model="form.roles"
                  :options="roles.data"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Elige uno"
                  label="name"
                  track-by="id"
                />
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
                <LoadingButton :loading="form.processing" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
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
              <div class="col-span-6 sm:col-span-3">
                <InputLabel for="current-password" value="Contraseña actual"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                <TextInput
                    id="current-password"
                    type="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="••••••••"
                />
              </div>
              <div class="col-span-6 sm:col-span-3">
                <InputLabel for="password" value="Nueva Contraseña"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                <TextInput
                    id="password"
                    type="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="••••••••"
                />
              </div>
              <div class="col-span-6 sm:col-span-3">

                <InputLabel for="confirm-password" value="Confirmar Contraseña"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                <TextInput
                    id="confirm-password"
                    type="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="••••••••"
                />
              </div>
              <div class="col-span-6 sm:col-full">
                <LoadingButton :loading="form.processing" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
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
            Roles asignados
          </h3>
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
                v-for="userRole in user.data.roles"
                :key="userRole.id"
                class="hover:bg-gray-100 dark:hover:bg-gray-700"
              >
                <td
                  class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                >
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ userRole.name }}
                  </div>
                </td>
                <td class="p-4 space-x-2 whitespace-nowrap">
                  <a
                  @click="confirmRoleToRemove(userRole)"
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
              <tr v-if="user.data.roles.length === 0">
                <td class="px-6 py-4 border-t dark:text-gray-400" colspan="4">
                  No se encontraron roles asignados para este usuario.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <h3 class="mb-4 text-xl font-semibold dark:text-white">
            Permisos asignados
          </h3>
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
                v-for="userPermission in user.data.permissions"
                :key="userPermission.id"
                class="hover:bg-gray-100 dark:hover:bg-gray-700"
              >
                <td
                  class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                >
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ userPermission.name }}
                  </div>
                </td>
                <td class="p-4 space-x-2 whitespace-nowrap">
                  <a
                   @click="confirmPermissionToRevoke(userPermission)"
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
              <tr v-if="user.data.permissions.length === 0">
                <td class="px-6 py-4 border-t dark:text-gray-400" colspan="4">
                  No se encontraron permisos asignados para este usuario.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Revoke Permission Confirmation Modal -->
    <DialogConfirmation :show="confirmingPermissionToRevoke" @close="closeModal">
        <template #title> Revocar Permiso </template>

        <template #content>
            ¿Estás seguro de que quieres revocar este Permiso?
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
     <!-- Revoke Role Confirmation Modal -->
    <DialogConfirmation :show="confirmingRoleToRemove" @close="closeModal">
        <template #title> Revocar Rol </template>

        <template #content>
            ¿Estás seguro de que quieres revocar este Rol?
        </template>

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
