<template>
  <li>
    <a
      :href="`/creators/${hit.channel}/${hit.id}`"
      class="flex items-center py-4 transition duration-150 ease-in-out rounded-md hover:border-gray-100 hover:bg-gray-100"
      tabindex="-1"
    >
      <div class="w-4 h-4 ml-2">
        <component :is="`${hit.channel}-logo`" class="w-4 h-4" />
      </div>
      <span class="ml-2 meili" v-html="hit.name"></span>
    </a>
  </li>
</template>

<script>
import YoutubeLogo from './Logos/YoutubeLogo.vue'
import WebsiteLogo from './Logos/WebsiteLogo.vue'
import TwitterLogo from './Logos/TwitterLogo.vue'
import TwitchLogo from './Logos/TwitchLogo.vue'
import RedditLogo from './Logos/RedditLogo.vue'
import VimeoLogo from './Logos/VimeoLogo.vue'
import GithubLogo from './Logos/GithubLogo.vue'
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  components: {
    YoutubeLogo,
    GithubLogo,
    WebsiteLogo,
    RedditLogo,
    TwitchLogo,
    TwitterLogo,
    VimeoLogo
  },

  props: {
    hit: {
      type: Object,
      required: true
    }
  }
})
</script>

<style>
.meili em {
  background-color: #ffffed;
}
</style>
