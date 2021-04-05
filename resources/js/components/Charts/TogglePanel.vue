<template>
  <div class="relative text-xxs">
    <div class="flex justify-end">
      <div
        class="flex items-center px-1 py-0.5 space-x-0.5 bg-gray-100 rounded-md"
      >
        <div v-if="toggleable">
          <button
            v-for="(days, label) in buttons"
            :key="label"
            @click="toggle(days)"
            class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
            :class="{ 'bg-white': days === filteringDays }"
          >
            {{ label }}
          </button>
        </div>
        <button
          @click="screenshot"
          class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
          aria-label="screenshot"
        >
          <base-icon-screenshot class="w-3 h-3"></base-icon-screenshot>
        </button>
        <button
          @click="webShare"
          v-if="isWebShareSupported"
          aria-label="share"
          class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
        >
          <base-icon-share class="w-3 h-3"></base-icon-share>
        </button>
        <social-share-panel
          v-else
          :share-message="shareMessage"
        ></social-share-panel>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from '@vue/runtime-core'
import useWebShare from '../Composables/useWebShare'
import SocialSharePanel from './SocialSharePanel.vue'

export default defineComponent({
  components: {
    SocialSharePanel
  },
  props: {
    toggleable: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      required: true
    }
  },
  emits: ['screenshot', 'toggle'],
  setup(props, { emit }) {
    const filteringDays = ref(null)
    const shareMessage = `Check out this ${props.title} chart`

    const buttons = {
      '7D': 7,
      '1M': 30,
      '3M': 90,
      '1Y': 365,
      All: null
    }
    const { webShare, isSupported: isWebShareSupported } = useWebShare(
      shareMessage
    )

    const screenshot = () => {
      emit('screenshot')
    }

    const toggle = (days) => {
      filteringDays.value = days
      emit('toggle', days)
    }

    return {
      screenshot,
      buttons,
      toggle,
      filteringDays,
      isWebShareSupported,
      webShare,
      shareMessage
    }
  }
})
</script>
