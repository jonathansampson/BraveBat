<template>
  <div>
    <label
      :for="name"
      class="block text-xs font-semibold text-gray-400 uppercase"
      >{{ inputLabel }}</label
    >
    <input
      :type="type"
      :id="name"
      :name="name"
      @input="input"
      :value="modelValue"
      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring-1 focus:ring-orange-200"
    />
    <div class="pt-1 text-xs text-red-500" v-if="error">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { computed, defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'BaseFormInput',
  props: {
    name: {
      type: String,
      required: true
    },
    modelValue: {
      type: String,
      default: '',
      required: true
    },
    error: {
      type: String,
      requiree: false
    },
    type: {
      type: String,
      default: 'text'
    },
    label: {
      type: String,
      required: false
    }
  },
  setup(props, { emit }) {
    const input = (event) => {
      emit('update:modelValue', event.target.value)
    }
    const inputLabel = computed(() => (props.label ? props.label : props.name))
    return { input, inputLabel }
  }
})
</script>

<style></style>
