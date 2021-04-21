<template>
  <button
    :type="type"
    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md bg-brand-orange focus:outline-none hover:bg-orange-600 focus:bg-orange-600 focus:border-yellow-400 focus:ring focus:ring-offset-0 focus:ring-yellow-200 focus:ring-opacity-50"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'button'
    }
  }
}
</script>
