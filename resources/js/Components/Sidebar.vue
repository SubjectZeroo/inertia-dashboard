<script setup>
import { computed, onMounted, onUnmounted, watch, ref } from 'vue';
import { useDark, useToggle, onClickOutside } from "@vueuse/core";
import SidebarLink from "@/Components/SidebarLink.vue";
import DropdownSidebar from "@/Components/DropdownSidebar.vue";
import NavItem from "@/Components/NavItem.vue";
import { usePermission } from "@/Composables/Permissions.js";
import { HomeIcon,HomeModernIcon,ChartPieIcon, UserIcon, CogIcon, TruckIcon, UsersIcon, ArchiveBoxIcon } from "@heroicons/vue/24/outline";
import useEventsBus from '@/Composables/eventBus.js';
import useDetectOutsideClick from '@/Composables/useDetectOutsideClick'

const { emit } = useEventsBus();

const { bus } = useEventsBus();

const isDark = useDark();

const toggleDark = useToggle(isDark);

const isHamburgerMenuOpen = ref(false);


const props = defineProps({
    title: String
});


watch(() => bus.value.get('sidebarCollapsed'), (val) => {
    // destruct the parameters
    const [sidebarCollapsedBus] = val ?? [];

    isHamburgerMenuOpen.value = sidebarCollapsedBus;

});

watch(() => bus.value.get('close'), (val) => {
    const [sidebarCollapsedBus] = val ?? []
    isHamburgerMenuOpen.value = sidebarCollapsedBus
});


const navItems = [
    {
        href: route("dashboard"),
        active: route().current("dashboard"),
        roles: ["Super Admin"],
        label: "Dashboard",
        children: [],
        icon: ChartPieIcon,
    },
    {
        href: "#",
        active: false,
        roles: ["Super Admin"],
        label: "Clientes",
        icon: UsersIcon,
        children: [
            {
                href: route("customers.index"),
                active: route().current("customers.index"),
                roles: ["Super Admin"],
                label: "Lista Clientes",
                children: [],
                icon: null,
            },
            {
                href: route("customer-locations.index"),
                active: route().current("customer-locations.index"),
                roles: ["Super Admin"],
                label: "Locaciones Clientes",
                children: [],
                icon: null,
            },
        ],

    },
    {
        href: "#",
        active: false,
        roles: ["Super Admin"],
        label: "Vehiculos",
        icon: TruckIcon,
        children: [
            {
                href: route("vehicles.index"),
                active: route().current("vehicles.index"),
                roles: ["Super Admin"],
                label: "Lista Vehiculos",
                children: [],
                icon: null,
            },
            {
                href: route("vehicle-models.index"),
                active: route().current("vehicle-models.index"),
                roles: ["Super Admin"],
                label: "Modelos",
                children: [],
                icon: null,
            },
            {
                href: route("vehicle-brands.index"),
                active: route().current("vehicle-brands.index"),
                roles: ["Super Admin"],
                label: "Marcas",
                children: [],
                icon: null,
            },
        ],
    },
    {
        href: "#",
        active: false,
        roles: ["Super Admin"],
        label: "Articulos",
        icon: ArchiveBoxIcon,
        children: [
            {
                href: route("items.index"),
                active: route().current("items.index"),
                roles: ["Super Admin"],
                label: "Lista Articulos",
                children: [],
                icon: null,
            },
            {
                href: route("item-brands.index"),
                active: route().current("item-brands.index"),
                roles: ["Super Admin"],
                label: "Marcas",
                children: [],
                icon: null,
            },
            {
                href: route("item-categories.index"),
                active: route().current("item-categories.index"),
                roles: ["Super Admin"],
                label: "Categorias",
                children: [],
                icon: null,
            },
            {
                href: route("item-subcategories.index"),
                active: route().current("item-subcategories.index"),
                roles: ["Super Admin"],
                label: "Subcategorias",
                children: [],
                icon: null,
            },
        ],
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
        href: "#",
        active: false,
        roles: ["Super Admin"],
        label: "Roles y Permisos",
        icon: CogIcon,
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

    },
];

</script>
<template>
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 -translate-x-full"
        :class="isHamburgerMenuOpen === false ? 'transform-none' : ''" aria-label="Sidebar">
        <div
            class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    <ul class="pb-2 space-y-2">
                        <NavItem :item="item" v-for="item in navItems" :key="item.label"> </NavItem>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</template>
