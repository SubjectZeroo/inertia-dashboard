<script setup>
import { ref, watch } from "vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import SearchFilter from "@/Components/SearchFilter.vue";
import Pagination from "@/Components/Pagination.vue";
import DialogConfirmation from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
  roles: Object,
  filters: Object,
});

const formSearch = ref({
  search: props.filters.search,
});

watch(
  () => formSearch.value,
  throttle(function () {
    router.get("/roles", pickBy(formSearch.value), { preserveState: true });
  }, 150),
  {
    deep: true,
  }
);

function reset() {
  formSearch.value = mapValues(formSearch.value, () => null);
}

const confirmingRoleDeletion = ref(false);
const roleADelete = ref("");
const form = useForm({});
const confirmRoleDeletion = (role) => {
  confirmingRoleDeletion.value = true;
  roleADelete.value = role.id;
};

const deleteRole = () => {
  form.delete(route("roles.destroy", roleADelete.value), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    // onError: () => passwordInput.value.focus(),
    // onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingRoleDeletion.value = false;
};
</script>

<template>
  <AppLayout title="Roles">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
    </template>
    <div
      class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="w-full mb-1">
        <div class="mb-4">
          <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol
              class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2"
            >
              <li class="inline-flex items-center">
                <Link
                  href="/dashboard"
                  class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
                >
                  <svg
                    class="w-5 h-5 mr-2.5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                    ></path>
                  </svg>
                  Dashboard
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
                    >Roles</span
                  >
                </div>
              </li>
            </ol>
          </nav>
          <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Roles
          </h1>
        </div>
        <div class="sm:flex">
          <div
            class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700"
          >
            <search-filter v-model="formSearch.search" @reset="reset"> </search-filter>
          </div>
          <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
            <Link
              id="createProductButton"
              href="/roles/create"
              class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button"
              data-drawer-target="drawer-create-product-default"
              data-drawer-show="drawer-create-product-default"
              aria-controls="drawer-create-product-default"
              data-drawer-placement="right"
            >
              <svg
                class="w-5 h-5 mr-2 -ml-1"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
              </svg>
              Agregar Rol
            </Link>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <div class="overflow-hidden shadow">
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
                  v-for="role in roles.data"
                  :key="role.id"
                  class="hover:bg-gray-100 dark:hover:bg-gray-700"
                >
                  <td
                    class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                  >
                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                      {{ role.name }}
                    </div>
                  </td>
                  <td class="p-4 space-x-2 whitespace-nowrap">
                    <Link
                      id="updateRoleButton"
                      :href="`/roles/${role.id}/edit`"
                      tabindex="-1"
                      data-drawer-target="drawer-update-user-default"
                      data-drawer-show="drawer-update-user-default"
                      aria-controls="drawer-update-user-default"
                      data-drawer-placement="right"
                      class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                      <svg
                        class="w-4 h-4 mr-2"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                        ></path>
                        <path
                          fill-rule="evenodd"
                          d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                      Actualizar
                    </Link>
                    <a
                    @click="confirmRoleDeletion(role)"
                      id="deleteRoleButton"
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
                      Eliminar
                    </a>
                  </td>
                </tr>
                <tr v-if="roles.data.length === 0">
                  <td class="px-6 py-4 border-t dark:text-gray-400" colspan="4">
                    No se encontraron Roles.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <pagination :registers="roles" />
     <!-- Delete Role Confirmation Modal -->
     <DialogConfirmation :show="confirmingRoleDeletion" @close="closeModal">
        <template #title> Eliminar Permiso </template>

        <template #content>
            ¿Estás seguro de que quieres eliminar este Rol?
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

            <DangerButton
            class="ml-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteRole()"
            >
            Eliminar Permiso
            </DangerButton>
        </template>
     </DialogConfirmation>
  </AppLayout>
</template>
