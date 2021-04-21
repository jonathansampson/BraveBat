<template>
  <li>
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <base-logo :website="advertiser.website"></base-logo>
        <div class="flex items-center space-x-2">
          <span class="text-lg">
            {{ advertiser.name }}
          </span>
          <a class="text-sm text-brand-orange" :href="advertiser.website">
            {{ advertiser.website }}
          </a>
        </div>
      </div>
      <div class="flex items-center space-x-2">
        <base-form-delete-icon-button @click="removeAdvertiser(advertiser.id)">
        </base-form-delete-icon-button>
      </div>
    </div>
  </li>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'AdsAdvertiserItem',
  emits: ['removeAdvertiser'],
  props: {
    advertiser: {
      type: Object,
      required: true
    }
  },
  setup(props, { emit }) {
    const removeAdvertiser = (advertiserId) => {
      emit('removeAdvertiser', advertiserId)
    }
    return { removeAdvertiser }
  }
})
</script>

<style></style>
