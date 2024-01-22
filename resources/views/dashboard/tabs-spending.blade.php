<div
    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Spending</h3>
        <span
            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $spendingThisMonth }}</span>
        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                    </path>
                </svg>
                {{ $percentageSpending }}%
            </span>
            Since last month
        </p>
    </div>
    <div class="w-full" id="spending-chart"></div>
</div>

@push('js')
    <script>
        const options = {
            colors: ['#1A56DB', '#FDBA8C'],
            series: [
                {
                    name: 'Spending',
                    color: '#1A56DB',
                    data: @json($tabsSpendingIncome['spendings'])
                }
            ],
            chart: {
                type: 'bar',
                height: '140px',
                fontFamily: 'Inter, sans-serif',
                foreColor: '#4B5563',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '90%',
                    borderRadius: 3
                }
            },
            tooltip: {
                shared : false,
                intersect: false,
                style: {
                    fontSize: '14px',
                    fontFamily: 'Inter, sans-serif'
                },
                y: {
                    formatter: function (val) {
                        return val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.');
                    }
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'darken',
                        value: 1
                    }
                }
            },
            stroke: {
                show: true,
                width: 5,
                colors: ['transparent']
            },
            grid: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                floating: false,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
            },
            yaxis: {
                show: false
            },
            fill: {
                opacity: 1
            }
        };

        if (document.getElementById("spending-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("spending-chart"), options);
            chart.render();
        }
    </script>
@endpush