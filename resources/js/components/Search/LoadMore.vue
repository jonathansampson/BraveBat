<template>
  <div v-if="loading">
    <base-button-orange-rounded class="px-3 py-1 text-sm">
      <div class="flex items-center space-x-1">
        <base-icon-spinner class="w-3 h-3"></base-icon-spinner>
        <span>Loading...</span>
      </div>
    </base-button-orange-rounded>
  </div>
  <div v-else>
    <base-button-orange-rounded @click="loadMore" class="px-3 py-1 text-sm">
      Load More
    </base-button-orange-rounded>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  props: {
    loading: {
      type: Boolean,
      required: true
    }
  },
  emits: ['load-more'],
  setup(props, { emit }) {
    const loadMore = () => {
      emit('load-more')
    }
    return { loadMore }
  }
})
</script>
