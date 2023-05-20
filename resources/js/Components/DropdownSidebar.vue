<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
let open = ref(false);
</script>

<template>
    <li>
        <button  @click="open = ! open" type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-crud" aria-expanded="false">
            <slot name="icon" />
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item><slot name="title" /></span>


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :class="{'rotate-90':open}">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>

        </button>
        <ul v-show="open" @click="open = false"  class="space-y-2 py-2" >
            <slot name="content" />
        </ul>
    </li>
</template>
