export default function useCapitalize() {
  const capitalize = (original) => {
    if (original === 'youtube') {
      return 'YouTube'
    }
    if (original === 'github') {
      return 'GitHub'
    }
    return original.charAt(0).toUpperCase() + original.slice(1)
  }

  return { capitalize }
}
