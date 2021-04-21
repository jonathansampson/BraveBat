<template>
  <div>
    <base-button @click="modal = true"> Add </base-button>
  </div>
  <base-modal :is-open="modal" @close="closeModal">
    <template v-slot:title>Add Advertiser</template>
    <form @submit.prevent="submit" class="pb-4">
      <div class="space-y-4">
        <base-form-input
          name="name"
          v-model="name"
          :error="nameError"
        ></base-form-input>
        <base-form-input
          name="website"
          v-model="website"
          :error="websiteError"
        ></base-form-input>
        <base-form-submit-button> Submit </base-form-submit-button>
      </div>
    </form>
  </base-modal>
</template>

<script>
import { defineComponent, ref } from '@vue/runtime-core'
import axios from 'axios'
import useToast from '../Composables/useToast'

export default defineComponent({
  name: 'AdsAdvertiserCreate',
  emits: ['submit'],
  setup(props, { emit }) {
    const { successToast, errorToast } = useToast()
    const modal = ref(false)
    const name = ref('')
    const website = ref('')
    const nameError = ref('')
    const websiteError = ref('')

    const closeModal = () => {
      modal.value = false
    }

    const clearForm = () => {
      name.value = ''
      website.value = ''
      websiteError.value = ''
      nameError.value = ''
    }
    const submit = () => {
      let data = {
        name: name.value,
        website: website.value
      }
      axios
        .post('/ads_advertisers_api', data)
        .then((res) => {
          successToast()
          clearForm()
          closeModal()
          emit('submit', res.data)
        })
        .catch((error) => {
          let validationErrors = error.response.data.errors
          nameError.value = validationErrors.name
            ? validationErrors.name[0]
            : ''
          websiteError.value = validationErrors.website
            ? validationErrors.website[0]
            : ''
          errorToast()
        })
    }
    return {
      name,
      website,
      submit,
      nameError,
      websiteError,
      modal,
      closeModal
    }
  }
})
</script>

<style></style>
