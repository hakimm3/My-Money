    <div class="card">
        <div id="category-chart"></div>
    </div>


@push('scripts')
    <script>
          var data = [];
        @foreach ($totalPengeluaran as $item)
            data.push({
                name: '{{ $item->name }}',
                y: {{ $item->total }}
            })
        @endforeach
    </script>

    <script>

        if ($('#category-chart').length) {
            var pieColors = (function() {
                var colors = [],
                    base = Highcharts.getOptions().colors[0],
                    i;

                for (i = 0; i < 10; i += 1) {
                    // Start out with a darkened base color (negative brighten), and end
                    // up with a much brighter color
                    colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
                }
                return colors;
            }());

            // Build the chart
            Highcharts.chart('category-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Presentase Pengeluaran Per Kategori'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        colors: pieColors,
                        dataLabels: {
                            style: {
                                "color": "contrast",
                                "fontSize": "11px",
                                "fontWeight": "bold",
                                "textOutline": ""
                            },
                            enabled: true,
                            format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                            distance: -50,
                            filter: {
                                property: 'percentage',
                                operator: '>',
                                value: 4
                            }
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: data
                }]
            });
        }
    </script>
@endpush