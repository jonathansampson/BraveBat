<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1 class="text-xl">Advertisers</h1>
      <ads-advertiser-create @submit="submit"></ads-advertiser-create>
    </div>
    <div>
      <base-search-input
        v-model="term"
        @clear="clearSearch"
        placeholder="Search Advertisers"
      ></base-search-input>
    </div>
    <div>
      <ul class="space-y-4">
        <ads-advertiser-item
          v-for="advertiser in filteredAdvertisers"
          :key="advertiser.id"
          :advertiser="advertiser"
          @removeAdvertiser="removeAdvertiser"
        >
        </ads-advertiser-item>
      </ul>
    </div>
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, ref } from '@vue/runtime-core'
import axios from 'axios'
import AdsAdvertiserItem from './AdsAdvertiserItem'
import AdsAdvertiserCreate from './AdsAdvertiserCreate'
import useToast from '../Composables/useToast'
import useAlert from '../Composables/useAlert'

export default defineComponent({
  name: 'AdsAdvertiserList',
  components: {
    AdsAdvertiserItem,
    AdsAdvertiserCreate
  },
  setup() {
    const { successToast, errorToast } = useToast()
    const { deleteAlert } = useAlert()
    const term = ref('')
    const advertisers = ref([])
    const clearSearch = () => {
      term.value = ''
    }

    const filteredAdvertisers = computed(() => {
      return advertisers.value.filter((advertiser) =>
        advertiser.name.toLowerCase().includes(term.value.toLowerCase())
      )
    })

    onMounted(() => {
      axios.get('/ads_advertisers_api').then((res) => {
        advertisers.value = res.data
      })
    })

    const submit = (advertiser) => {
      advertisers.value.unshift(advertiser)
    }
    const removeAdvertiser = (advertiserId) => {
      deleteAlert(() => {
        axios
          .delete('/ads_advertisers/' + advertiserId)
          .then((res) => {
            advertisers.value = advertisers.value.filter(
              (advertiser) => advertiser.id !== advertiserId
            )
            successToast('Deleted successfully')
          })
          .catch((err) => {
            errorToast('Something went wrong')
          })
      })
    }
    return {
      advertisers,
      removeAdvertiser,
      submit,
      term,
      clearSearch,
      filteredAdvertisers
    }
  }
})
</script>
