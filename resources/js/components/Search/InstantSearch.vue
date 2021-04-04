<template>
  <div class="relative" ref="instantSearchBox">
    <search-input v-model="term" @clear="clearTerm"></search-input>
    <div
      v-if="term"
      class="absolute right-0 z-50 w-64 mt-2 text-sm border border-gray-200"
    >
      <ul v-if="hits.length">
        <instant-search-item
          v-for="(hit, index) in hits.slice(0, 5)"
          :key="index"
          :hit="hit"
        >
        </instant-search-item>
        <li class="py-1 text-right bg-white">
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
import { defineComponent, ref, watch } from '@vue/runtime-core'
import SearchInput from './SearchInput'
import useSearch from '../Composables/useSearch'
import InstantSearchItem from './InstantSearchItem'
import useClickOutside from '../Composables/useClickOutside'

export default defineComponent({
  components: {
    SearchInput,
    InstantSearchItem
  },
  setup() {
    const instantSearchBox = ref(null)
    const term = ref('')
    const clearTerm = () => (term.value = '')
    const { hits, search } = useSearch()
    useClickOutside(instantSearchBox, clearTerm)

    watch(term, () => {
      search({
        term: term.value
      })
    })
    return { term, clearTerm, hits, instantSearchBox }
  }
})
</script>

<style></style>
