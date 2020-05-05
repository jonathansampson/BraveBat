<div>
  <canvas id="{{$id}}"></canvas>
</div>

@push('scripts')

<script defer>
  axios.post("/charts/{{$id}}")
    .then(res => {
      if (res.status == 200) {
        let data = res.data;
        let labels = data.labels;
        let unit = "{!! isset($unit) ? $unit : 'month' !!}";
        let colors = {!! json_encode(config('bravebat.colors')) !!}
        let brand_color = "{!! isset($brand_color) ? config('bravebat.creator_brand_colors')[$brand_color] : null !!}";
        let datasets = [];
        Object.keys(data.data).forEach((key, index) => {
          let hidden = index == 0 ? false : true;
          let myNewDataset = {
            label: key,
            borderWidth: 1,
            data: data.data[key],
            backgroundColor: brand_color ? brand_color : colors[index],
            borderColor: brand_color ? brand_color : colors[index],
            fill: false,
            borderCapStyle: "butt",
            pointRadius: 3,
            lineTension: 0,
            hidden: hidden,
            cubicInterpolationMode: "default"
          };
          datasets.push(myNewDataset);
        });
        var ctx = document.getElementById("{{$id}}");
        var myChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: datasets
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
                  distribution: "series",
                  type: "time",
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
                  distribution: "linear"
                }
              ]
            }
          }
        });
      }
    });
</script>
@endpush