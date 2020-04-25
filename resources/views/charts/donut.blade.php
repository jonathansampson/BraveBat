<div>
    <canvas id='{{$id}}'></canvas>
</div>

@push('scripts')
<script defer>
    axios.post("/charts/{{$id}}")
    .then(res => {
        if (res.status == 200) {
            let data = res.data;
            let labels = data.labels;
            let colors = {!! json_encode(config('bravebat.creator_brand_colors')) !!}
            let brandColors = labels.map(label => colors[label]);
            let datasets = [{
                data: data.data,
                backgroundColor: brandColors
            }];
            var ctx = document.getElementById('{{$id}}');
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "bottom",
                    }
                }
            })
        }
    })
</script>
@endpush