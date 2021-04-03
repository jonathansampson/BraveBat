<template>
  <li>
    <a
      :href="`/creators/${result.channel}/${result.id}`"
      class="flex items-center py-4 transition duration-150 ease-in-out text-brand-dark hover:bg-gray-700 hover:text-brand-light"
      tabindex="-1"
    >
      <div class="w-4 h-4 ml-2">
        <component :is="`base-logo-${result.channel}`" class="w-4 h-4" />
      </div>
      <span class="ml-2">{{ result.name }}</span>
    </a>
  </li>
</template>

<script>
export default {
  props: {
    result: {
      type: Object,
      required: true
    }
  }
}
</script>
