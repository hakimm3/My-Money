<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
            <span
                class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $mainWidgetData['totalSpending'] }}</span>
            <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Spending this week
            </h3>
        </div>
    </div>
    <div id="chart"></div>
    <!-- Card Footer -->
    <div
        class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="weekly-sales-dropdown">Last 7 days <svg
                    class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="weekly-sales-dropdown">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white"
                        role="none">
                        Sep 16, 2021 - Sep 22, 2021
                    </p>
                </div>
                <ul class="py-1" role="none">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 90 days</a>
                    </li>
                </ul>
                <div class="py-1" role="none">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Custom...</a>
                </div>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="#"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                Sales Report
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

@push('js')
    <script>
        const getMainChartOptions = () => {
        let mainChartColors = {}
    
        if (document.documentElement.classList.contains('dark')) {
            mainChartColors = {
                borderColor: '#374151',
                labelColor: '#9CA3AF',
                opacityFrom: 0,
                opacityTo: 0.15,
            };
        } else {
            mainChartColors = {
                borderColor: '#F3F4F6',
                labelColor: '#6B7280',
                opacityFrom: 0.45,
                opacityTo: 0,
            }
        }
    
        return {
            chart: {
                height: 420,
                type: 'area',
                fontFamily: 'Inter, sans-serif',
                foreColor: mainChartColors.labelColor,
                toolbar: {
                    show: false
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    enabled: true,
                    opacityFrom: mainChartColors.opacityFrom,
                    opacityTo: mainChartColors.opacityTo
                }
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                style: {
                    fontSize: '14px',
                    fontFamily: 'Inter, sans-serif',
                },
            },
            grid: {
                show: true,
                borderColor: mainChartColors.borderColor,
                strokeDashArray: 1,
                padding: {
                    left: 35,
                    bottom: 15
                }
            },
            series: [
                {
                    name: 'Income',
                    data: @json($mainWidgetData['income']),
                    color: '#1A56DB'
                },
                {
                    name: 'Expenses',
                    data: @json($mainWidgetData['spending']),
                    color: '#FDBA8C'
                }
            ],
            markers: {
                size: 5,
                strokeColors: '#ffffff',
                hover: {
                    size: undefined,
                    sizeOffset: 3
                }
            },
            xaxis: {
                categories: @json($mainWidgetData['dates']),
                labels: {
                    style: {
                        colors: [mainChartColors.labelColor],
                        fontSize: '14px',
                        fontWeight: 500,
                    },
                },
                axisBorder: {
                    color: mainChartColors.borderColor,
                },
                axisTicks: {
                    color: mainChartColors.borderColor,
                },
                crosshairs: {
                    show: true,
                    position: 'back',
                    stroke: {
                        color: mainChartColors.borderColor,
                        width: 1,
                        dashArray: 10,
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: [mainChartColors.labelColor],
                        fontSize: '14px',
                        fontWeight: 500,
                    },
                    formatter: function (value) {
                        if(value != undefined){
                            return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return value;
                        }
                    }
                },
            },
            legend: {
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Inter, sans-serif',
                labels: {
                    colors: [mainChartColors.labelColor]
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            responsive: [
                {
                    breakpoint: 1024,
                    options: {
                        xaxis: {
                            labels: {
                                show: false
                            }
                        }
                    }
                }
            ]
        };
    }

    if (document.getElementById("chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("chart"), getMainChartOptions());
      chart.render();

        // init again when toggling dark mode
        document.addEventListener('dark-mode', function () {
            chart.updateOptions(getMainChartOptions());
        });

    }
    </script>
@endpush