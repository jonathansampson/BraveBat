import { useShare } from '@vueuse/core'

export default function useWebShare(shareMessage) {
  const { share, isSupported } = useShare()
  const webShare = () => {
    return share({
      text: shareMessage,
      url: location.href
    }).catch(function (e) {})
  }
  return { webShare, isSupported }
}
