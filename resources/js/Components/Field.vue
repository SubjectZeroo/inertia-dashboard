<script setup>
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { v4 as uuid } from "uuid";
import {computed , provide} from "vue";
const props = defineProps({
  id: {
    type: String,
    default: () => `field-${uuid()}`,
  },
  label: String,
  required: Boolean,
  error: String,
  help: String,
});

const ariaDescribedBy = computed(() => {
    return !!props.help ? `help-${uuid()}` : null;
})

provide("field", computed(() => {
    return {
        ...props,
        invalid: !!props.error,
        ariaDescribedBy: ariaDescribedBy.value,
    }
}));
</script>

<template>
  <!-- <div class="grid grid-cols-6 gap-6"> -->
    <!-- <div class="col-span-6 sm:col-span-3"> -->
      <Label v-if="props.label" :for="props.id" required> {{ props.label }} </Label>
      <!-- <Input

        :id="props.id"
        type="text"
        :required="props.required"
        :invalid="!!props.errors"
      /> -->
      <slot v-bind="props"/>
      <InputError class="mt-2" :message="props.error" />
    <!-- </div> -->
  <!-- </div> -->
</template>
