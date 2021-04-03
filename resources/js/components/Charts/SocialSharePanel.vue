<template>
  <Menu>
    <MenuButton
      class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
    >
      <base-icon-share class="w-3 h-3"></base-icon-share>
    </MenuButton>
    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-out"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="absolute right-0 flex items-center justify-center p-0.5 mt-2 origin-top-right bg-white border border-gray-100 rounded-md outline-none top-4"
      >
        <MenuItem>
          <a
            class="rounded-sm outline-none cursor-pointer hover:bg-gray-50 p-0.5"
            :href="twitterIntentUrl"
            target="_blank"
          >
            <base-logo-twitter class="w-3 h-3"></base-logo-twitter>
          </a>
        </MenuItem>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { defineComponent } from '@vue/runtime-core'

export default defineComponent({
  components: {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem
  },
  props: {
    shareMessage: {
      type: String,
      required: true
    }
  },
  setup(props) {
    let params = {
      text: props.shareMessage,
      url: location.href,
      via: 'BraveBatInfo'
    }

    var esc = encodeURIComponent
    var query = Object.keys(params)
      .map((k) => esc(k) + '=' + esc(params[k]))
      .join('&')

    const twitterIntentUrl = 'https://twitter.com/intent/tweet?' + query
    return { twitterIntentUrl }
  }
})
</script>
