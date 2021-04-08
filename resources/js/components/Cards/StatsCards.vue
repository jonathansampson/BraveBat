<template>
  <div class="flex items-center py-8 bg-gray-50" v-if="creatorsByChannels">
    <div class="container px-4 mx-auto sm:px-6 md:px-8">
      <div class="grid grid-cols-2 gap-2 sm:gap-6 lg:grid-cols-4">
        <stats-card
          :count="overallCreatorsCount"
          channelLogo="base-logo-brave"
          channelName="Overall"
        ></stats-card>
        <stats-card
          :count="creatorsByChannel.data"
          :channelName="capitalize(creatorsByChannel.category)"
          :channelLogo="`base-logo-${creatorsByChannel.category}`"
          v-for="creatorsByChannel in creatorsByChannels"
        ></stats-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from '@vue/runtime-core'
import axios from 'axios'
import StatsCard from './StatsCard'
import useCapitalize from '../Composables/useCapitalize'

export default defineComponent({
  name: 'StatsCards',
  components: {
    StatsCard
  },
  setup() {
    const { capitalize } = useCapitalize()
    const creatorsByChannels = ref()
    const overallCreatorsCount = ref(0)
    axios.post('/api/v2/stats/creators_by_channels').then((res) => {
      creatorsByChannels.value = res.data
      overallCreatorsCount.value = res.data.reduce((a, c) => {
        return a + c.data
      }, 0)
    })
    return { creatorsByChannels, capitalize, overallCreatorsCount }
  }
})
</script>

<style></style>
