<script setup>
import { onMounted, ref, inject } from 'vue';

const props = defineProps({
    id: String,
    modelValue: [String, Number],
    required: Boolean,
    invalid: Boolean,
    ariaDescribedBy: String,
});

const emit = defineEmits(['update:modelValue']);

const input = ref(null);

const field = inject('field', props);
// onMounted(() => {
//     if (input.value.hasAttribute('autofocus')) {
//         input.value.focus();
//     }
// });

// defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
       :id="field.id"
       :value="props.modelValue"
       @input="$emit('update:modelValue', $event.target.value)"
       :required="field.required"
       :class="['shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500', field.invalid ? 'dark:border-red-500 border-red-500' : '']"
    />
</template>
