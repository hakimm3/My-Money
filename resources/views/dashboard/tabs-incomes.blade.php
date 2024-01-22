<div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Income</h3>
        <span
            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $incomeThisMonth }}</span>
        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            @if ($percentageIncome > 0)
                <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                    <i class="fa-solid fa-arrow-up"></i>
                    {{ $percentageIncome }}%
                </span>
            @else
                <span class="flex items-center mr-1.5 text-sm text-red-500 dark:text-red-400">
                    <i class="fa-solid fa-arrow-down"></i>
                    {{ $percentageIncome }}%
                </span>
            @endif
            Since last month
        </p>
    </div>
    <div class="w-full" id="incomes-chart"></div>
</div>

@push('js')
    <script>
         const getSignupsChartOptions = () => {
        let signupsChartColors = {}
    
        if (document.documentElement.classList.contains('dark')) {
            signupsChartColors = {
                backgroundBarColors: ['#374151', '#374151', '#374151', '#374151', '#374151', '#374151', '#374151']
            };
        } else {
            signupsChartColors = {
                backgroundBarColors: ['#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB']
            };
        }
    
        return {
            series: [{
                name: 'Incomes',
                data: @json($tabsSpendingIncome['incomes'])
            }],
            chart: {
                type: 'bar',
                height: '140px',
                foreColor: '#4B5563',
                fontFamily: 'Inter, sans-serif',
                toolbar: {
                    show: false
                }
            },
            theme: {
                monochrome: {
                    enabled: true,
                    color: '#1A56DB'
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '25%',
                    borderRadius: 3,
                    colors: {
                        backgroundBarColors: signupsChartColors.backgroundBarColors,
                        backgroundBarRadius: 3
                    },
                },
                dataLabels: {
                    hideOverflowingLabels: false
                }
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
            tooltip: {
                shared: true,
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
                        value: 0.8
                    }
                }
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                show: false
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
        };
    }

    if (document.getElementById("incomes-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("incomes-chart"), getSignupsChartOptions());
      chart.render();

        // init again when toggling dark mode
        document.addEventListener('dark-mode', function () {
            chart.updateOptions(getSignupsChartOptions());
        });

    }
    </script>
@endpush