<template>
  <li class="hover:bg-gray-100">
    <a
      :href="`/creators/${hit.channel}/${hit.id}`"
      class="flex items-center justify-between px-2 py-4 transition duration-150 ease-in-out"
    >
      <div class="flex items-center">
        <component :is="`base-logo-${hit.channel}`" class="w-6 h-6" />
        <span class="ml-2 meili" v-html="hit.name"></span>
      </div>
      <div>
        <div v-if="hit.channel === 'website'" class="flex flex-col items-end">
          <div class="text-gray-500 uppercase text-xxs">Alexa Ranking</div>
          <div>
            {{ hit.alexa_ranking.toLocaleString() }}
          </div>
        </div>
        <div v-else class="flex flex-col items-end">
          <div class="text-gray-500 uppercase text-xxs">Followers</div>
          <div>
            {{ hit.follower_count.toLocaleString() }}
          </div>
        </div>
      </div>
    </a>
  </li>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  props: {
    hit: {
      type: Object,
      required: true
    }
  }
})
</script>

<style>
.meili em {
  background-color: #ffffed;
}
</style>
