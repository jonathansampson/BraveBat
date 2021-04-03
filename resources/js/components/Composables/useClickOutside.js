import { onMounted, onUnmounted } from '@vue/runtime-core'

export default function useClickOutside(el, callback) {
  const listener = (e) => {
    if (e.target !== el.value && !el.value.contains(e.target)) {
      callback()
    }
  }
  onMounted(() => {
    document.addEventListener('click', listener)
  })

  onUnmounted(() => {
    document.removeEventListener('click', listener)
  })
}
