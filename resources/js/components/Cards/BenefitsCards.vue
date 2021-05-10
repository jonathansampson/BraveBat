<template>
  <div class="flex items-center pb-16 bg-white">
    <div class="container px-4 mx-auto sm:px-6 md:px-8">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <benefits-card
          v-for="card in cards"
          :key="card"
          :card="card"
        ></benefits-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'
import BenefitsCard from './BenefitsCard'

export default defineComponent({
  name: 'BenefitsCards',
  components: {
    BenefitsCard
  },
  setup() {
    const cards = [
      {
        icon: 'BaseLogoBat',
        text: 'Earn BAT Crypto When You Surf the Internet'
      },
      {
        icon: 'BaseIconPrivacy',
        text: 'Browse 3x Faster than Chrome While Preserving Privacy'
      },
      {
        icon: 'BaseIconPalette',
        text: 'Support Creators by Tipping and Auto-Contributing BAT'
      }
    ]
    return { cards }
  }
})
</script>
