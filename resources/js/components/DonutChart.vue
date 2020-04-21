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
  props: ["colors", "identifier"],
  mounted: function() {
    this.id = this.identifier;
    axios.post("/charts/" + this.identifier).then(res => {
      if (res.status == 200) {
        let data = res.data;
        this.labels = data.labels;
        let colors = JSON.parse(this.colors);
        let brandColors = this.labels.map(label => colors[label]);
        this.datasets = [
          {
            data: data.data,
            backgroundColor: brandColors
          }
        ];
      }

      var ctx = document.getElementById(this.id);
      ctx.height = 200;

      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: this.labels,
          datasets: this.datasets
        },
        options: {
          responsive: true,
          legend: {
            display: true,
            position: "bottom",

            labels: {}
          }
        }
      });
    });
  }
};
</script>

<style>
</style>

