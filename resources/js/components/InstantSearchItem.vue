<template>
  <li>
    <a
      :href="`creators/${result.channel}/${result.id}`"
      class="flex items-center py-4 transition duration-150 ease-in-out text-brand-dark hover:bg-gray-700 hover:text-brand-light"
      tabindex="-1"
    >
      <div class="w-4 h-4 ml-2">
        <component :is="`${result.channel}-logo`" class="w-4 h-4" />
      </div>
      <span class="ml-2">{{ result.name }}</span>
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

export default {
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
    result: {
      type: Object,
      required: true
    }
  }
}
</script>
