<template>
  <div class="flex items-center justify-center w-8 h-8 sm:w-12 sm:h-12">
    <img :src="logoSrc" />
  </div>
</template>

<script>
import { computed, defineComponent } from '@vue/runtime-core'

export default defineComponent({
  name: 'BaseLogo',
  props: {
    website: {
      type: String,
      required: true
    }
  },
  setup(props) {
    const logoSrc = computed(
      () => '//logo.clearbit.com/' + props.website + '?size=80'
    )
    return { logoSrc }
  }
})
</script>

<style></style>
