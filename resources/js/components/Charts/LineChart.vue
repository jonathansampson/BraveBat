<template>
  <button @click="setFilteringDay(7)">7D</button>
  <div>{{ labels }}</div>
  <div>{{ datasets }}</div>
  <base-line-chart :labels="labels" :datasets="datasets"></base-line-chart>
</template>

<script>
import BaseLineChart from './BaseLineChart.vue'
import { ref } from '@vue/runtime-core'

export default {
  components: {
    BaseLineChart
  },
  setup() {
    const data = ref(null)
    const datasets = ref([])
    const labels = ref([])
    const filteringDays = ref(null)
    axios.post('/charts/dau').then((response) => {
      data.value = response.data
    })

    const setFilteringDay = (num) => {
      console.log(num)
    }

    return {
      filteringDays,
      labels,
      datasets,
      data,
      setFilteringDay
    }
  }
}
</script>

<style></style>
