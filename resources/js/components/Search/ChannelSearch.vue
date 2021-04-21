<template>
  <div class="">
    <div
      class="flex flex-col py-4 pt-8 sm:space-x-4 sm:flex-row sm:justify-between sm:items-center"
    >
      <div class="w-full sm:w-64">
        <base-search-input
          v-model="term"
          @clear="clearTerm"
          :auto-focus="true"
          placeholder="Search Creators"
        ></base-search-input>
      </div>
      <div class="pt-4 text-sm text-center sm:pt-0" v-if="totalCreators">
        {{ totalCreators.toLocaleString() }} Found
      </div>
    </div>

    <div v-if="totalCreators">
      <ul
        v-if="hits.length"
        class="border border-gray-100 divide-y divide-gray-100 rounded"
      >
        <advanced-search-item
          v-for="(hit, index) in hits"
          :key="index"
          :hit="hit"
        >
        </advanced-search-item>
      </ul>
      <div class="flex justify-center mt-4" v-if="hasMore">
        <load-more :loading="loading" @load-more="loadMore"></load-more>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, ref } from '@vue/runtime-core'
import AdvancedSearchItem from './AdvancedSearchItem'
import useSearch from '../Composables/useSearch'
import { debouncedWatch } from '@vueuse/core'
import LoadMore from './LoadMore'

export default defineComponent({
  name: 'ChannelSearch',
  props: {
    channel: {
      type: String,
      required: true
    },
    count: {
      type: Number,
      required: true
    }
  },
  components: {
    AdvancedSearchItem,
    LoadMore
  },
  setup(props) {
    const term = ref()
    const offset = computed(() => hits.value.length)
    const searchOptions = computed(() => ({
      term: term.value,
      channels: [props.channel]
    }))

    const {
      hits,
      channels,
      totalCreators,
      search,
      hasMore,
      loading
    } = useSearch()

    onMounted(() => {
      search(searchOptions.value)
    })

    debouncedWatch(
      term,
      () => {
        search(searchOptions.value)
      },
      {
        debounce: 200
      }
    )

    const clearTerm = () => {
      term.value = ''
    }

    const loadMore = () => {
      search({
        ...searchOptions.value,
        offset: offset.value
      })
    }

    return {
      term,
      search,
      hits,
      channels,
      clearTerm,
      totalCreators,
      loadMore,
      hasMore,
      loading
    }
  }
})
</script>
