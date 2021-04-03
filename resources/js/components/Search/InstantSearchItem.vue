<template>
  <li>
    <a
      :href="`/creators/${hit.channel}/${hit.id}`"
      class="flex items-center py-4 transition duration-150 ease-in-out bg-gray-100 text-brand-dark hover:bg-gray-200"
      tabindex="-1"
    >
      <div class="w-4 h-4 ml-2">
        <component :is="`base-logo-${hit.channel}`" class="w-4 h-4" />
      </div>
      <span class="ml-2 meili" v-html="hit.name"></span>
    </a>
  </li>
</template>

<script>
export default {
  props: {
    hit: {
      type: Object,
      required: true
    }
  }
}
</script>

<style>
.meili em {
  background-color: #ffffed;
}
</style>
