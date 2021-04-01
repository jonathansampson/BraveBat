import { useShare } from '@vueuse/core'

export default function useWebShare() {
  const { share, isSupported } = useShare()
  const chartShare = () => {
    return share({
      url: location.href
    }).catch(function (e) {})
  }
  return { chartShare, isSupported }
}
