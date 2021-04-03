<template>
  <div>
    <div class="relative z-30">
      <input
        id="search"
        v-model.trim="term"
        aria-label="search"
        name="search"
        autocomplete="off"
        type="text"
        class="w-64 px-8 py-2 text-sm bg-gray-300 rounded-full text-brand-dark focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-50"
        placeholder="Search Verified Creators"
        @keyup="debouncedFn"
      />
      <div class="absolute inset-y-0 flex items-center left-2">
        <base-icon-search class="w-4 h-4 text-gray-500"></base-icon-search>
      </div>
      <div
        v-if="loading"
        class="absolute inset-y-0 right-0 flex items-center mr-3"
      >
        <svg
          class="w-5 h-5 animate-spin text-brand-orange"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
          />
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
          />
        </svg>
      </div>

      <div
        v-if="searchReady"
        class="absolute z-50 w-64 mt-3 text-sm bg-gray-200"
      >
        <ul v-if="results.length" class="divide-y divide-gray-400">
          <InstantSearchItem
            v-for="(result, index) in results"
            :key="index"
            :result="result"
          >
          </InstantSearchItem>
        </ul>
        <div
          v-if="!results.length && !loading"
          class="px-3 py-3 text-brand-dark"
        >
          No results for '{{ term }}'!
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useDebounceFn } from '@vueuse/core'
import InstantSearchItem from './InstantSearchItem'
import axios from 'axios'
import { ref } from '@vue/reactivity'
import { computed, defineComponent } from '@vue/runtime-core'

export default defineComponent({
  components: {
    InstantSearchItem
  },

  setup() {
    const term = ref('')
    const results = ref([])
    const loading = ref(false)

    const search = () => {
      if (searchReady.value) {
        loading.value = true
        results.value = []

        axios.post(`/search?term=${term.value}`).then((response) => {
          results.value = response.data
          loading.value = false
        })
      }
    }

    const debouncedFn = useDebounceFn(() => {
      search()
    }, 250)

    const searchReady = computed(() => term.value.length >= 3)

    return { term, results, loading, search, searchReady, debouncedFn }
  }
})
</script>
