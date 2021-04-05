const colors = [
  '#fb542b',
  '#4299e1',
  '#667eea',
  '#9f7aea',
  '#ed64a6',
  '#a0aec0',
  '#f56565',
  '#ed8936',
  '#ecc94b',
  '#48bb78',
  '#38b2ac',
  '#90cdf4',
  '#a3bffa',
  '#d6bcfa',
  '#fbb6ce',
  '#e2e8f0',
  '#feb2b2',
  '#fbd38d',
  '#faf089',
  '#9ae6b4',
  '#81e6d9'
]

const brandColors = {
  youtube: '#ff0000',
  reddit: '#ff4500',
  twitch: '#6441a5',
  vimeo: '#1ab7ea',
  github: '#4078c0',
  twitter: '#1da1f2',
  website: '#343546'
}

export const useLineChartData = (data, days, brand = null) => {
  let labels = days ? data.labels.slice(0, days) : data.labels
  let datasets = []
  Object.keys(data.data).forEach((key, index) => {
    const temp = days ? data.data[key].slice(0, days) : data.data[key]
    let myNewDataset = {
      label: key,
      borderWidth: 1,
      data: temp,
      backgroundColor: brand ? brandColors[brand] : colors[index],
      borderColor: brand ? brandColors[brand] : colors[index],
      fill: false,
      borderCapStyle: 'butt',
      pointRadius: temp.length > 30 ? 1 : 3,
      lineTension: 0,
      cubicInterpolationMode: 'default'
    }
    datasets.push(myNewDataset)
  })

  return {
    labels,
    datasets
  }
}

export const useDonutChartData = (data) => {
  let labels = data.labels
  let colors = labels.map((label) => brandColors[label])
  let datasets = [
    {
      data: data.data,
      backgroundColor: colors
    }
  ]
  return {
    labels,
    datasets
  }
}

export const useLineChartOption = () => {
  return {
    plugins: {
      legend: {
        display: true,
        labels: {
          boxWidth: 12,
          usePointStyle: false
        }
      }
    },
    scales: {
      x: {
        type: 'time',
        grid: {
          display: false
        },
        ticks: {
          autoSkip: true,
          maxRotation: 0,
          autoSkipPadding: 20
        },
        time: {
          unit: 'month'
        }
      },
      y: {
        suggestedMin: 0
      }
    }
  }
}

export const useDonutChartOption = () => {
  return {
    responsive: true,
    aspectRatio: 2,
    plugins: {
      legend: {
        display: true,
        position: 'bottom'
      }
    }
  }
}
