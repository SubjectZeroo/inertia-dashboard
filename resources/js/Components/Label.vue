<script setup>
const props = defineProps({
   for: String,
   required: Boolean,
   value: String,
});
</script>

<template>
   <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" :for="props.for">
        <slot />
        <span class="text-red-600">*</span>
    </label>
</template>
