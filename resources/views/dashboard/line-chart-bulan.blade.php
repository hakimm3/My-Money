<canvas id="linechart" width="400" height="100"></canvas>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let data_bulan = [];
        let data_label = [];
        @foreach ($totalPengeluaranPerBulan as $item)
            data_bulan.push({{ $item->total }} )
            data_label.push('{{ $item->bulan }}')
        @endforeach
    </script>
    <script>
        const chart_1 = $('#linechart');
        const linechart = new Chart(chart_1, {
            type: 'line',
            data: {
                labels: data_label,
                datasets: [{
                    label: 'Statistik Pengeluaran Per Bulan',
                    data: data_bulan,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                backgroundColor: '#999',
                borderColor: 'rgb(75, 192, 192)',
            }
        });
    </script>
@endpush
