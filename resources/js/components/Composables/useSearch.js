import { ref } from '@vue/reactivity'
import { computed } from '@vue/runtime-core'
import { isEmpty } from 'lodash'

export default function useSearch(searchOptions) {
  const hits = ref([])
  const channels = ref({})
  const totalCreators = computed(() => {
    if (isEmpty(channels.value)) return 0
    return Object.values(channels.value).reduce((a, b) => a + b)
  })

  const search = () => {
    axios.post('/meili', searchOptions.value).then((response) => {
      hits.value = response.data.hits
      channels.value = response.data.channels
    })
  }

  return { hits, channels, totalCreators, search }
}
