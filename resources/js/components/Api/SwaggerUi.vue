<template>
  <div id="myDomId"></div>
</template>

<script>
import { defineComponent, onMounted } from '@vue/runtime-core'
import SwaggerUI from 'swagger-ui'
import 'swagger-ui/dist/swagger-ui.css'

export default defineComponent({
  setup() {
    onMounted(() => {
      SwaggerUI({
        url: '/storage/api.v2.json',
        dom_id: '#myDomId'
      })
    })
  }
})
</script>

<style></style>
