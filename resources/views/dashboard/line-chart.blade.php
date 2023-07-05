<div id="amlinechart4"></div>

@push('scripts')
    <script>
        if ($('#amlinechart4').length) {
            var data = @json($totalPemasukanPengeluaranPerBulan);
            console.log(data)
            var chart = AmCharts.makeChart("amlinechart4", {
                "type": "serial",
                "theme": "dark",
                "legend": {
                    "useGraphSettings": true
                },
                "dataProvider": data,

                "startDuration": 0.5,
                "graphs": [{
                    "balloonText": "Pemasukan Selama [[category]]: [[value]]",
                    "bullet": "round",
                    "title": "Pemasukan",
                    "valueField": "totalPemasukan",
                    "fillAlphas": 0,
                    "lineColor": "#9656e7",
                    "lineThickness": 2,
                    "negativeLineColor": "#c69cfd"
                }, {
                    "balloonText": "Pengeluaran Selama [[category]]: [[value]]",
                    "bullet": "round",
                    "title": "Pengeluaran",
                    "valueField": "total",
                    "fillAlphas": 0,
                    "lineColor": "#31aeef",
                    "lineThickness": 2,
                    "negativeLineColor": "#31aeef",
                }],
                "chartCursor": {
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "bulan",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "fillAlpha": 0.05,
                    "fillColor": "#000000",
                    "gridAlpha": 0,
                    "position": "bottom"
                },
                "export": {
                    "enabled": false
                }
            });
        }
    </script>
@endpush
