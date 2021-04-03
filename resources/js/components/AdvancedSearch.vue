<template>
  <div class="flex flex-col sm:space-x-4 sm:flex-row">
    <div class="w-full p-4 sm:w-64 sm:border sm:border-gray-100 sm:rounded-lg">
      <div class="relative text-gray-700">
        <input
          v-model.trim="term"
          aria-label="search"
          name="search"
          autocomplete="off"
          type="text"
          class="w-full px-8 py-2 text-sm placeholder-gray-300 bg-gray-100 border-none rounded-full focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-50"
          placeholder="Search"
          ref="advancedSearch"
        />
        <div class="absolute inset-y-0 flex items-center left-3">
          <search-icon class="w-4 h-4"></search-icon>
        </div>
        <div class="absolute inset-y-0 flex items-center right-3" v-if="term">
          <button
            class="flex items-center justify-center p-0.5 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-200 hover:bg-gray-200"
            @click="clearTerm"
          >
            <close-icon class="w-4 h-4"></close-icon>
          </button>
        </div>
      </div>
      <div class="hidden px-1 py-4 sm:block">
        <div class="flex justify-between mb-1 text-gray-500">
          <h1 class="font-semibold uppercase">Channel</h1>
          <div class="flex items-center">
            <button
              class="px-2 text-xs text-gray-400 bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-200 hover:bg-gray-50"
              @click="clearSelectedChannels"
              v-if="selectedChannels.length"
            >
              Clear
            </button>
          </div>
        </div>
        <div class="space-y-2 text-sm">
          <div
            v-for="(element, index) in channels"
            :key="index"
            class="flex items-center justify-between"
          >
            <div class="flex items-center">
              <input
                type="checkbox"
                :name="element"
                v-model="selectedChannels"
                :value="index"
                :id="element"
                class="mr-2 border-gray-300 rounded shadow-sm text-brand-orange focus:border-yellow-400 focus:ring focus:ring-offset-0 focus:ring-yellow-200 focus:ring-opacity-50"
              />
              <label class="capitalize" :for="element">
                {{ index }}
              </label>
            </div>
            <div class="px-2 text-xs text-gray-700 bg-gray-100 rounded-full">
              {{ element.toLocaleString() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex-1">
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
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref, watch } from '@vue/runtime-core'
import axios from 'axios'
import SearchIcon from './Icons/SearchIcon'
import CloseIcon from './Icons/CloseIcon'
import AdvancedSearchItem from './AdvancedSearchItem'

export default defineComponent({
  components: {
    SearchIcon,
    CloseIcon,
    AdvancedSearchItem
  },
  setup() {
    const term = ref('')
    const hits = ref([])
    const channels = ref({})
    const selectedChannels = ref([])
    const advancedSearch = ref(null)
    const search = () => {
      axios
        .post('/meili', {
          term: term.value,
          channels: selectedChannels.value
        })
        .then((response) => {
          hits.value = response.data.hits
          channels.value = response.data.channels
        })
    }

    onMounted(() => {
      advancedSearch.value.focus()
      search()
    })

    watch([selectedChannels, term], () => {
      search()
    })

    const clearTerm = () => {
      term.value = ''
    }

    const clearSelectedChannels = () => {
      selectedChannels.value = []
    }

    return {
      term,
      search,
      hits,
      channels,
      selectedChannels,
      advancedSearch,
      clearSelectedChannels,
      clearTerm
    }
  }
})
</script>
