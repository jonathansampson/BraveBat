<template>
  <div class="relative" ref="instantSearchBox">
    <base-search-input
      v-model="term"
      @clear="clearTerm"
      placeholder="Search Creators"
    ></base-search-input>
    <div
      v-if="hits.length && term"
      class="absolute right-0 z-50 w-64 mt-2 text-sm border border-gray-200"
    >
      <ul>
        <instant-search-item
          v-for="(hit, index) in hits.slice(0, 5)"
          :key="index"
          :hit="hit"
        >
        </instant-search-item>
        <li class="py-1 text-right bg-gray-50">
          <a
            :href="`/search?term=${term}`"
            class="pr-1 text-xs font-semibold underline text-brand-orange hover:opacity-70"
          >
            Advanced Search
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from '@vue/runtime-core'
import useSearch from '../Composables/useSearch'
import InstantSearchItem from './InstantSearchItem'
import useClickOutside from '../Composables/useClickOutside'
import { debouncedWatch } from '@vueuse/core'

export default defineComponent({
  components: {
    InstantSearchItem
  },
  setup() {
    const instantSearchBox = ref(null)
    const term = ref('')
    const clearTerm = () => (term.value = '')
    const { hits, search } = useSearch()
    useClickOutside(instantSearchBox, clearTerm)

    debouncedWatch(
      term,
      () => {
        search({
          term: term.value
        })
      },
      { debounce: 200 }
    )
    return { term, clearTerm, hits, instantSearchBox }
  }
})
</script>

<style></style>
