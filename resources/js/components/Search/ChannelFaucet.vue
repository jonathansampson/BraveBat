<template>
  <div>
    <div class="flex justify-between mb-1 text-gray-500">
      <h1 class="font-semibold uppercase">Channel</h1>
      <div class="flex items-center">
        <base-button-gray-rounded @click="clear" v-if="selectedChannels.length">
          <div class="px-2 text-xs">Clear</div>
        </base-button-gray-rounded>
      </div>
    </div>

    <div class="space-y-2 text-sm">
      <div
        v-for="(count, channel) in channels"
        :key="channel"
        class="flex items-center justify-between"
      >
        <base-input-checkbox
          :checked="checkValue(channel)"
          @update:checked="toggle(channel)"
          :name="channel.charAt(0).toUpperCase() + channel.slice(1)"
        >
        </base-input-checkbox>
        <base-pill-gray-rounded>
          {{ count.toLocaleString() }}
        </base-pill-gray-rounded>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'ChannelFaucet',
  props: {
    channels: {
      type: Object,
      required: true
    },
    selectedChannels: {
      type: Array,
      required: true
    }
  },
  emit: ['clear', 'toggle'],
  setup(props, { emit }) {
    const toggle = (channel) => {
      emit('toggle', channel)
    }
    const checkValue = (value) => {
      return props.selectedChannels.includes(value)
    }
    const clear = () => {
      emit('clear')
    }
    return { toggle, checkValue, clear }
  }
})
</script>

<style></style>
