<template>
  <a
    class="inline-block text-white rounded-full bg-brand-orange focus:outline-none hover:bg-orange-600 focus:bg-orange-600 focus:border-yellow-400 focus:ring focus:ring-offset-0 focus:ring-yellow-200 focus:ring-opacity-50"
    :href="href"
  >
    <slot></slot>
  </a>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  props: {
    href: {
      type: String,
      required: true
    }
  }
})
</script>
