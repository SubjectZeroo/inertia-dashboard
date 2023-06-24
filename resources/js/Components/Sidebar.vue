<script setup>
import { useDark, useToggle } from "@vueuse/core";
import SidebarLink from "@/Components/SidebarLink.vue";
import DropdownSidebar from "@/Components/DropdownSidebar.vue";
import NavItem from "@/Components/NavItem.vue";
import { usePermission } from "@/Composables/Permissions.js";
import { HomeIcon, UserIcon, CogIcon, TruckIcon } from "@heroicons/vue/24/outline";
defineProps({
  title: String,
  dropdownLinks: {
    type: Array,
    default: () => [
      { text: "Roles", route: "roles.index" },
      { text: "Permisos", route: "permissions.index" },
    ],
  },
});

const isDark = useDark();
const toggleDark = useToggle(isDark);

const navItems = [
  {
    href: route("dashboard"),
    active: route().current("dashboard"),
    roles: ["Super Admin"],
    label: "Dasboard",
    children: [],
    icon: HomeIcon,
  },
  {
    href: route("users.index"),
    active: route().current("users.index"),
    roles: ["Super Admin"],
    label: "Usuarios",
    children: [],
    icon: UserIcon,
  },
  {
    href: route("machines.index"),
    active: route().current("machines.index"),
    roles: ["Super Admin"],
    label: "Maquinarias",
    children: [],
    icon: TruckIcon,
  },
  {
    href: "#",
    active: false,
    roles: ["Super Admin"],
    label: "Roles y Permisos",
    children: [
      {
        href: route("roles.index"),
        active: route().current("roles.index"),
        roles: ["Super Admin"],
        label: "Roles",
        children: [],
        icon: null,
      },
      {
        href: route("permissions.index"),
        active: route().current("permissions.index"),
        roles: ["Super Admin"],
        label: "Permisos",
        children: [],
        icon: null,
      },
    ],
    icon: CogIcon,
  },
];
</script>
<template>
  <aside
    id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar"
  >
    <div
      class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
        <div
          class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
        >
          <ul class="pb-2 space-y-2">
            <NavItem :item="item" v-for="item in navItems" :key="item.label"> </NavItem>
          </ul>
        </div>
      </div>
    </div>
  </aside>
</template>
