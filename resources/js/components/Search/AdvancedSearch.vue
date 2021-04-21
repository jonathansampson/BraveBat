<template>
  <div class="flex flex-col sm:space-x-4 sm:flex-row">
    <div class="w-full sm:w-64">
      <base-search-input
        v-model="term"
        @clear="clearTerm"
        :auto-focus="true"
        placeholder="Search Creators"
      ></base-search-input>
      <div>
        <div class="mt-4 mb-4 sm:hidden">
          <div class="flex items-center justify-between">
            <div class="text-lg font-semibold">
              <div v-if="totalCreators">{{ totalCreators }} Creators Found</div>
            </div>
            <div>
              <base-button-orange-rounded
                class="p-1"
                @click="toggleMobileChannelFaucet"
                aria-label="channel faucet"
                :aria-expanded="mobileChannelFaucet"
              >
                <base-icon-close v-if="mobileChannelFaucet" class="w-4 h-4" />
                <base-icon-filter v-else class="w-4 h-4" />
              </base-button-orange-rounded>
            </div>
          </div>
          <base-transition>
            <div class="px-1 py-2" v-if="mobileChannelFaucet">
              <channel-faucet
                :channels="channels"
                :selected-channels="selectedChannels"
                @clear="clearSelectedChannels"
                @toggle="toggleChannel"
              />
            </div>
          </base-transition>
        </div>
        <div class="hidden px-1 py-2 sm:block">
          <channel-faucet
            :channels="channels"
            :selected-channels="selectedChannels"
            @clear="clearSelectedChannels"
            @toggle="toggleChannel"
          />
        </div>
      </div>
    </div>

    <div class="flex-1 px-1 sm:px-4" v-if="totalCreators">
      <div class="hidden mb-2 text-lg font-semibold sm:block">
        {{ totalCreators.toLocaleString() }} Creators Found
      </div>
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
import ChannelFaucet from './ChannelFaucet'
import useSearch from '../Composables/useSearch'
import { debouncedWatch } from '@vueuse/core'
import LoadMore from './LoadMore'

export default defineComponent({
  name: 'AdvancedSearch',
  props: {
    initialTerm: {
      type: String,
      default: ''
    }
  },
  components: {
    AdvancedSearchItem,
    ChannelFaucet,
    LoadMore
  },
  setup(props) {
    const term = ref(props.initialTerm)
    const selectedChannels = ref([])
    const mobileChannelFaucet = ref(false)
    const offset = computed(() => hits.value.length)
    const searchOptions = computed(() => ({
      term: term.value,
      channels: selectedChannels.value
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
      [selectedChannels, term],
      () => {
        search(searchOptions.value)
      },
      {
        deep: true,
        debounce: 200
      }
    )

    const clearTerm = () => {
      term.value = ''
    }

    const clearSelectedChannels = () => {
      selectedChannels.value = []
    }

    const toggleChannel = (channel) => {
      if (selectedChannels.value.includes(channel)) {
        selectedChannels.value.splice(
          selectedChannels.value.indexOf(channel),
          1
        )
      } else {
        selectedChannels.value.push(channel)
      }
    }

    const toggleMobileChannelFaucet = () => {
      mobileChannelFaucet.value = !mobileChannelFaucet.value
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
      selectedChannels,
      clearSelectedChannels,
      clearTerm,
      totalCreators,
      toggleChannel,
      toggleMobileChannelFaucet,
      mobileChannelFaucet,
      loadMore,
      hasMore,
      loading
    }
  }
})
</script>
