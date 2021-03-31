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

export const useChartData = (data, days, brand = null) => {
  let labels
  if (days) {
    labels = data.labels.slice(0, days)
  } else {
    labels = data.labels
  }
  let datasets = []
  Object.keys(data.data).forEach((key, index) => {
    let temp
    if (days) {
      temp = data.data[key].slice(0, days)
    } else {
      temp = data.data[key]
    }
    let myNewDataset = {
      label: key,
      borderWidth: 1,
      data: temp,
      backgroundColor: brand ? brandColors[brand] : colors[index],
      borderColor: brand ? brandColors[brand] : colors[index],
      fill: false,
      borderCapStyle: 'butt',
      pointRadius: 3,
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

export const useLineChatOption = (unit = 'month') => {
  return {
    legend: {
      display: true,
      labels: {
        boxWidth: 12,
        usePointStyle: false
      }
    },
    scales: {
      xAxes: [
        {
          gridLines: {
            display: false
          },
          ticks: {
            autoSkip: true,
            maxRotation: 0,
            autoSkipPadding: 10
          },
          distribution: 'series',
          type: 'time',
          time: {
            unit: unit
          }
        }
      ],
      yAxes: [
        {
          ticks: {
            suggestedMin: 0,
            autoSkip: true
          },
          distribution: 'linear'
        }
      ]
    }
  }
}
