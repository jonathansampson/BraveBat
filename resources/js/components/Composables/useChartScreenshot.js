export default function useChartScreenshot() {
  const chartScreenshot = (filename, imageSrc) => {
    let a = document.createElement('a')
    a.href = imageSrc
    a.download = `${filename}.png`
    a.click()
  }

  return { chartScreenshot }
}
