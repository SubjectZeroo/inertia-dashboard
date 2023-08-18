<script setup>
import { ref,watch } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { useDark, useToggle, onClickOutside } from "@vueuse/core";
import Banner from "@/Components/Banner.vue";
import Sidebar from "@/Components/Sidebar.vue";
import NavBar from "@/Components/NavBar.vue";
import ToastList from "@/Components/ToastList.vue";
import useEventsBus from '@/Composables/eventBus.js';
import useDetectOutsideClick from '@/Composables/useDetectOutsideClick'
import { vOnClickOutside } from '@vueuse/components';

const {emit}=useEventsBus();

const props = defineProps({
  title: String,
  closeable: {
        type: Boolean,
        default: true,
    },
});

const isDark = useDark();
const toggleDark = useToggle(isDark);
const { bus } = useEventsBus()
const isHamburgerMenuOpen = ref(false);




watch(()=>bus.value.get('sidebarCollapsed'), (val) => {
  // destruct the parameters
    const [sidebarCollapsedBus] = val ?? []
    isHamburgerMenuOpen.value = sidebarCollapsedBus
})
// watch(()=> bus.value.get('close'), (val) => {
//     // console.log(val);
//     //isHamburgerMenuOpen.value = false;
//   // destruct the parameters
//      const [sidebarCollapsedBus] = val ?? []
//     isHamburgerMenuOpen.value = sidebarCollapsedBus
//     // console.log( isHamburgerMenuOpen.value );
// });

const ignoreElRef = ref()

const onClickOutsideHandler = [
  (ev) => {
    console.log(ev.isTrusted)
    isHamburgerMenuOpen.value = ev.isTrusted;
    emit('close', isHamburgerMenuOpen.value);
  },
  { ignore: [ignoreElRef] }
]
</script>

<template>
  <Head :title="title" />

  <Banner />
  <NavBar  ref="ignoreElRef"/>
  <!-- inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 -->
  <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

    <Sidebar v-on-click-outside="onClickOutsideHandler"/>
    <!-- Page Content -->
    <div
      class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 sm:hidden"
      :class="isHamburgerMenuOpen === true ? 'hidden' : ''"
      id="sidebarBackdrop"
    ></div>
    <div
      id="main-content"
      class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
    >
      <main>
        <ToastList/>


        <slot />
      </main>
    </div>
  </div>
</template>
