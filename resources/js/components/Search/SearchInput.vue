<template>
  <div class="relative text-gray-700">
    <input
      aria-label="search"
      name="search"
      autocomplete="off"
      type="text"
      class="w-full px-8 py-2 text-sm placeholder-gray-300 border border-gray-200 rounded-full bg-gray-50 focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-50"
      placeholder="Search Creators"
      :value="modelValue"
      @input="onChanged"
    />
    <div class="absolute inset-y-0 flex items-center left-3">
      <base-icon-search class="w-4 h-4"></base-icon-search>
    </div>
    <div class="absolute inset-y-0 flex items-center right-3" v-if="modelValue">
      <base-button-gray-rounded @click="clear" class="p-1">
        <base-icon-close class="w-4 h-4"></base-icon-close>
      </base-button-gray-rounded>
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  emits: ['update:modelValue'],
  props: {
    modelValue: String
  },
  setup(props, { emit }) {
    const onChanged = (e) => {
      emit('update:modelValue', e.currentTarget.value)
    }
    const clear = () => {
      emit('clear')
    }
    return {
      onChanged,
      clear
    }
  }
})
</script>
