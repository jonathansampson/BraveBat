<template>
  <div class="p-2 bg-white">
    <div class="relative flex items-center space-x-8">
      <div>
        <component :is="card.icon" class="w-16 h-16"></component>
      </div>
      <div class="tracking-wide text-gray-700">
        {{ card.text }}
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'BenefitsCard',
  props: {
    card: {
      type: Object,
      required: true
    }
  }
})
</script>
