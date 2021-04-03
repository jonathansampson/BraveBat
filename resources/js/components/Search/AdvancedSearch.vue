<template>
  <div class="flex flex-col sm:space-x-4 sm:flex-row">
    <div class="w-full p-4 sm:w-64 sm:border sm:border-gray-100 sm:rounded-lg">
      <search-input v-model="term" @clear="clearTerm"></search-input>
      <div>
        <div class="mt-4 sm:hidden">
          <div class="flex items-center justify-between">
            <div class="text-lg font-semibold">
              {{ totalCreators.toLocaleString() }} Creators Found
            </div>
            <div>
              <base-button-gray-rounded
                class="p-1"
                @click="toggleMobileChannelFaucet"
              >
                <base-icon-close
                  v-if="mobileChannelFaucet"
                  class="w-4 h-4 text-brand-orange"
                />
                <base-icon-filter v-else class="w-4 h-4 text-brand-orange" />
              </base-button-gray-rounded>
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

    <div class="flex-1 px-2">
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
    </div>
  </div>
</template>

<script>
import {
  computed,
  defineComponent,
  onMounted,
  ref,
  watch,
  watchEffect
} from '@vue/runtime-core'
import AdvancedSearchItem from './AdvancedSearchItem'
import SearchInput from './SearchInput'
import ChannelFaucet from './ChannelFaucet'
import useSearch from '../Composables/useSearch'

export default defineComponent({
  name: 'AdvancedSearch',
  components: {
    AdvancedSearchItem,
    SearchInput,
    ChannelFaucet
  },
  setup() {
    const term = ref('')
    const selectedChannels = ref([])
    const mobileChannelFaucet = ref(false)
    const searchOptions = computed(() => ({
      term: term.value,
      channels: selectedChannels.value
    }))

    const { hits, channels, totalCreators, search } = useSearch(searchOptions)

    onMounted(() => {
      search()
    })

    watch(
      [selectedChannels, term],
      () => {
        search()
      },
      {
        deep: true
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
      mobileChannelFaucet
    }
  }
})
</script>
