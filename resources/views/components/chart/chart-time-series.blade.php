<div>
    <h1 class="text-primary text-title font-weight-bold " style="font-size: 20px">{{ucfirst($title)}}</h1>
    <canvas id="{{$title}}" height="{{$height}}"></canvas>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            function shuffle(array) {
                var currentIndex = array.length, randomIndex;
                while (currentIndex != 0) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex--;
                    [array[currentIndex], array[randomIndex]] = [
                        array[randomIndex], array[currentIndex]];
                }
                return array;
            }

            var statistics_chart = document.getElementById("{{$title}}").getContext('2d');
            var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            @foreach($datas as $index=>$da)
            @if ($index==0)
            @continue
            @elseif ($index==1)
            var labels = [
                @foreach($da as $d)
                    month[{{$d}} - 1],
                @endforeach
            ];
            @else
            var data{{$index}} = [
                @foreach($da as $d)
                    {{$d}},
                @endforeach
            ];
            @endif
            @endforeach
            var borderColor = ['#FAA255', '#F0C348', '#E27CF1', '#F562AC', '#EB5959', '#9EE67A', '#50D989', '#66CFF2', '#7F7CE6'];
            borderColor = shuffle(borderColor);
            new Chart(statistics_chart, {
                type: '{{$type}}',
                data: {
                    labels: labels,
                    datasets: [
                            @foreach($datas as $index=>$da)
                            @if($index==0 or $index==1)
                            @continue
                            @else
                        {
                            label: '{{$datas[0][$index-2]}}',
                            data: data{{$index}},
                            borderWidth: 5,
                            borderColor: borderColor[({{$index}} - 2) % 12],
                            backgroundColor: borderColor[({{$index}} - 2) % 12] + '44',
                            pointBackgroundColor: '#fff',
                            pointBorderColor: borderColor[{{$index}} - 2 % 12],
                            pointRadius: 3
                        },
                        @endif
                        @endforeach
                    ]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            title: (tooltipItems, data) => data.datasets[tooltipItems[0].datasetIndex].label + ": " + tooltipItems[0].xLabel,

                            label:
                                function (tooltipItem, data) {
                                    const val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                    return 'Rp ' + numeral(val).format('0,0');
                                },
                        }
                    },

                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + numeral(value).format('0,0')
                                }
                            },

                        }],
                        xAxes: [{
                            gridLines: {
                                color: '#fbfbfb',
                                lineWidth: 2,
                            },

                        }]
                    },
                }
            });
        });
    </script>

</div>
