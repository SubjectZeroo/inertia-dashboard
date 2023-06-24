<script setup>
import {onMounted} from "vue";
import {  XMarkIcon, CheckCircleIcon} from "@heroicons/vue/24/outline";
    const props = defineProps({
        message: String
    });

    onMounted(() => {
        setTimeout(() => emit('remove'), 2000);
    })
    const emit = defineEmits(['remove']);
</script>
<template>
<div  class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-blue-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <CheckCircleIcon />
        <span class="sr-only">Fire icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">{{ props.message }}</div>
    <button @click="emit('remove')" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
        <span class="sr-only">Close</span>
        <XMarkIcon/>
    </button>
</div>
</template>
