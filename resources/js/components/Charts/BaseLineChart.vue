<template>
  <canvas ref="canvas"></canvas>
</template>

<script>
import Chart from 'chart.js'
import { ref, onMounted, watchEffect, watch } from 'vue'

export default {
  props: {
    labels: {
      type: Array,
      required: true
    },
    datasets: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const canvas = ref(null)
    const renderChart = () => {
      new Chart(canvas.value, {
        type: 'line',
        data: {
          labels: props.labels,
          datasets: props.datasets
        },
        options: {
          legend: {
            display: false,
            labels: {
              boxWidth: 14,
              usePointStyle: true
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
                  unit: 'month'
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
      })
    }
    onMounted(() => {
      renderChart()
    })
    // watch([props.labels.props.datasets], () => {
    //   console.log(12)
    // })
    return { canvas }
  }
}
</script>
