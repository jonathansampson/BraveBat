<template>
  <div class="flex items-center">
    <input
      type="checkbox"
      :name="name"
      :id="name"
      :checked="checked"
      @change="onChange"
      class="mr-2 border-gray-300 rounded shadow-sm text-brand-orange focus:border-yellow-400 focus:ring focus:ring-offset-0 focus:ring-yellow-200 focus:ring-opacity-50"
    />
    <label :for="name">
      {{ name }}
    </label>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'BaseInputCheckbox',
  props: {
    checked: {
      type: Boolean,
      default: false
    },
    name: {
      type: String,
      required: true
    }
  },
  setup(props, { emit }) {
    const onChange = (e) => {
      emit('update:checked', e.target.checked)
    }
    return { onChange }
  }
})
</script>

<style></style>
