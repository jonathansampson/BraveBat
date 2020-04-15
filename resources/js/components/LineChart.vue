<template>
  <canvas :id="this.identifier"></canvas>
</template>

<script>
import { Chart } from "chart.js/dist/Chart.js";

export default {
  data: function() {
    return {
      labels: [],
      datasets: [],
      id: ""
    };
  },
  props: ["colors", "identifier", "xTitle", "yTitle", "title"],
  mounted: function() {
    this.id = this.identifier;
    axios.post("/charts/" + this.identifier).then(res => {
      if (res.status == 200) {
        let data = res.data;
        this.labels = data.labels;
        let colors = JSON.parse(this.colors);
        Object.keys(data.data).forEach((key, index) => {
          let hidden = index == 0 ? false : true;
          let myNewDataset = {
            label: key,
            borderWidth: 1,
            data: data.data[key],
            backgroundColor: colors[index],
            borderColor: colors[index],

            fill: false
            // borderCapStyle: "butt",
            // pointRadius: 3,
            // lineTension: 0,
            // hidden: hidden,
            // cubicInterpolationMode: "default"
          };
          this.datasets.push(myNewDataset);
        });
      }
      var ctx = document.getElementById(this.id);
      var myChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: this.labels,
          datasets: this.datasets
        },
        options: {
          title: {
            display: true,
            text: this.title
          },
          legend: {
            display: true,
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
                scaleLabel: {
                  display: true,
                  labelString: this.xTitle
                }
              }
            ],
            yAxes: [
              {
                ticks: {
                  suggestedMin: 0
                },
                scaleLabel: {
                  display: true,
                  labelString: this.yTitle
                }
              }
            ]
          }
        }
      });
    });
  }
};
</script>

<style>
</style>

