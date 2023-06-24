<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/24/outline";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { usePermission } from "@/Composables/Permissions.js";
const { hasRoles } = usePermission();
const props = defineProps({
  item: Object,
  active: Boolean,
});
const hasActiveChild = computed(() => {
  function hasActiveItem(items) {
    return items.some((item) => item.active || hasActiveItem(item.children));
  }
  return hasActiveItem(props.item.children);
});
</script>
<template>
  <li v-if="hasRoles(item.roles)">
    <Link
      v-if="!item.children.length"
      :class="[
        'flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700',
        item.active ? 'bg-gray-100 dark:bg-gray-700 text-gray-200' : '',
      ]"
      :href="item.href"
    >
      <component
        :class="[
          'w-6 h-6 transition duration-75 group-hover:text-gray-900  dark:group-hover:text-white',
          item.active ? 'dark:text-gray-400 text-gray-600' : 'text-gray-500',
        ]"
        :is="item.icon"
        v-if="item.icon"
      ></component>
      <span class="ml-3">{{ item.label }}</span>
    </Link>
    <Disclosure v-else v-slot="{ open }" :default-open="hasActiveChild">
      <DisclosureButton
        :class="[
          'flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700',
        ]"
      >
        <component
          :class="[
            'w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white',
          ]"
          :is="item.icon"
          v-if="item.icon"
        ></component>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ item.label }}</span>
        <ChevronDownIcon :class="['w-6 h-6', open ? '-rotate-180' : '']" />
      </DisclosureButton>
      <DisclosurePanel>
        <ul class="space-y-2 py-2">
          <li v-for="child in item.children" :item="child">
            <Link
              :href="child.href"
              :class="[
                'flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700',
                child.active ? 'bg-gray-100 dark:bg-gray-700 text-gray-200' : '',
              ]"
              >{{ child.label }}</Link
            >
          </li>
        </ul>
      </DisclosurePanel>
    </Disclosure>
  </li>
</template>
