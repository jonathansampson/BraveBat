<template>
  <div class="p-2 bg-white rounded shadow-sm sm:p-5">
    <div class="flex items-center space-x-2 sm:space-x-4">
      <div>
        <div
          class="flex items-center justify-center w-8 h-8 rounded-full sm:w-12 sm:h-12 bg-gray-50"
        >
          <component
            :is="channelLogo"
            class="w-4 h-4 sm:w-6 sm:h-6"
          ></component>
        </div>
      </div>
      <div>
        <div class="text-xs text-gray-400 sm:text-base">{{ channelName }}</div>
        <div class="text-lg font-bold text-gray-900 sm:text-2xl">
          {{ count.toLocaleString() }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'StatsCard',
  props: {
    count: {
      type: Number,
      required: true
    },
    channelName: {
      type: String,
      required: true
    },
    channelLogo: {
      type: String,
      required: true
    }
  }
})
</script>

<style></style>
