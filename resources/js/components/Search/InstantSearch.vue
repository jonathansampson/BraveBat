<template>
  <div class="relative">
    <search-input v-model="term" @clear="clearTerm"></search-input>
    <div
      v-if="term"
      class="absolute right-0 z-50 w-56 mt-3 text-sm bg-gray-100"
    >
      <ul class="divide-y divide-gray-200" v-if="hits.length">
        <instant-search-item
          v-for="(hit, index) in hits.slice(0, 5)"
          :key="index"
          :hit="hit"
        >
        </instant-search-item>
        <li class="py-1 text-right">
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

export default defineComponent({
  components: {
    SearchInput,
    InstantSearchItem
  },
  setup() {
    const term = ref('')
    const clearTerm = () => {
      term.value = ''
    }
    const { hits, search } = useSearch()
    watch(term, () => {
      search({
        term: term.value
      })
    })
    return { term, clearTerm, hits }
  }
})
</script>

<style></style>
