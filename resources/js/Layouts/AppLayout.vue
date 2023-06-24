<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { useDark, useToggle } from "@vueuse/core";
import Banner from "@/Components/Banner.vue";
import Sidebar from "@/Components/Sidebar.vue";
import NavBar from "@/Components/NavBar.vue";
import ToastList from "@/Components/ToastList.vue";
defineProps({
  title: String,
});

const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>

<template>
  <Head :title="title" />

  <Banner />
  <NavBar />

  <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

    <Sidebar />
    <!-- Page Content -->
    <div
      class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90"
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
