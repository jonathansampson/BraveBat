import { ref } from '@vue/reactivity'
import { computed } from '@vue/runtime-core'

export default function useSearch() {
  const hits = ref([])
  const channels = ref({})
  const totalCreators = ref(0)
  const hasMore = computed(() => totalCreators.value > hits.value.length)
  const loading = ref(false)

  const search = (searchOptions) => {
    loading.value = true
    axios
      .post('/meili', searchOptions)
      .then((response) => {
        if (searchOptions.hasOwnProperty('offset')) {
          hits.value.push(...response.data.hits)
        } else {
          hits.value = response.data.hits
        }
        channels.value = response.data.channels
        totalCreators.value = response.data.nbHits
      })
      .finally(() => (loading.value = false))
  }

  return { hits, channels, totalCreators, search, hasMore, loading }
}
