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
import Table from "@/Components/Table.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableRow from "@/Components/TableRow.vue";
import {
  TrashIcon,
  PencilSquareIcon,
  ChevronRightIcon,
  HomeIcon,
  PlusIcon,
} from "@heroicons/vue/24/outline";
import toast from "@/Stores/toast.js";
const props = defineProps({
  items: Object,
  filters: Object,
});

const formSearch = ref({
  search: props.filters.search,
});

watch(
  () => formSearch.value,
  throttle(function () {
    router.get("/items", pickBy(formSearch.value), { preserveState: true });
  }, 150),
  {
    deep: true,
  }
);

function reset() {
  formSearch.value = mapValues(formSearch.value, () => null);
}

const confirmingItemDeletion = ref(false);
const itemADelete = ref("");
const form = useForm({});
const confirmItemDeletion = (item) => {
  confirmingItemDeletion.value = true;
  itemADelete.value = item.id;
};

const deleteItem = () => {
  form.delete(route("items.destroy", itemADelete.value), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    // onError: () => passwordInput.value.focus(),
    onFinish: () => addToast(),
  });
};
function addToast(params) {
  toast.add({
    message: "Item Eliminado",
  });
}
const closeModal = () => {
  confirmingItemDeletion.value = false;
};
</script>
<template>
     <AppLayout title="Articulos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Articulos</h2>
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
                  <HomeIcon class="w-5 h-5 mr-2.5" />
                  Dashboard
                </Link>
              </li>
              <li>
                <div class="flex items-center">
                  <ChevronRightIcon class="w-5 h-5 text-gray-400" />
                  <span
                    class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                    aria-current="page"
                    >Articulos</span
                  >
                </div>
              </li>
            </ol>
          </nav>
          <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Articulos
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
              href="/items/create"
              class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button"
              data-drawer-target="drawer-create-product-default"
              data-drawer-show="drawer-create-product-default"
              aria-controls="drawer-create-product-default"
              data-drawer-placement="right"
            >
            <PlusIcon class="w-5 h-5 mr-2 -ml-1" />
              Agregar Articulo
            </Link>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <Table>
            <template #header>
              <TableRow>
                <TableHeaderCell>Nombre</TableHeaderCell>
                <TableHeaderCell>Acciones</TableHeaderCell>
              </TableRow>
            </template>
            <template #default>
              <TableRow v-for="item in items.data" :key="item.id">
                <TableDataCell class="flex items-center">
                  <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ item.name }}
                  </div>
                </TableDataCell>
                <TableDataCell>
                  <Link
                    id="updateItemButton"
                    :href="`/items/${item.id}/edit`"
                    tabindex="-1"
                    data-drawer-target="drawer-update-item-default"
                    data-drawer-show="drawer-update-item-default"
                    aria-controls="drawer-update-item-default"
                    data-drawer-placement="right"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    <PencilSquareIcon class="w-4 h-4 mr-2" />
                    Actualizar
                  </Link>
                  <a
                    @click="confirmItemDeletion(item)"
                    id="deleteItemButton"
                    tabindex="-1"
                    data-drawer-target="drawer-delete-item-default"
                    data-drawer-show="drawer-delete-item-default"
                    aria-controls="drawer-delete-item-default"
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
    <pagination :registers="items" />

    <!-- Delete Account item Confirmation Modal -->
    <DialogConfirmation :show="confirmingItemDeletion" @close="closeModal">
      <template #title> Eliminar Articulo </template>

      <template #content>
        ¿Estás seguro de que quieres eliminar este Articulo? Una vez que su cuenta se
        elimine, todos sus recursos y datos se eliminarán permanentemente.
      </template>

      <template #footer>
        <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

        <DangerButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="deleteItem()"
        >
          Eliminar Articulo
        </DangerButton>
      </template>
    </DialogConfirmation>
  </AppLayout>
</template>
