<template>
  <div>
    <input
      id="search"
      v-model.trim="term"
      aria-label="search"
      name="search"
      autocomplete="off"
      type="text"
      class="w-64 px-8 py-2 text-sm bg-gray-300 rounded-full text-brand-dark focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-50"
      placeholder="Search Verified Creators"
      @keyup="search"
    />
  </div>
  <div>
    <div>Facets</div>
    <div>Output</div>
    <div v-for="result in results" :key="result.id">
      {{ result.id }}
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  setup() {
    const term = ref('')
    const results = ref([])
    const search = () => {
      console.log(12)
      // it will hit an endpoint and return data back
    }
    return { term, search, results }
  }
})
</script>

<style></style>
