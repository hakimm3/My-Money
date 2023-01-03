@extends('layout.app')
@push('title-page')
    Dashboard
@endpush
@push('breadcrumb')
    <li><span>Dashboard</span></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-5 mt-2">
            <div class="card">
                <div class="seo-fact sbg2">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Bulan Ini</div>
                        <h2>{{ $totalBulanIni }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mt-2" >
            @include('dashboard.category-pie')
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
           <div class="card">
            <div class="card-body">
                @include('dashboard.line-chart-bulan')
            </div>
           </div>
        </div>
    </div>
@endsection

@push('scripts')
     <!-- start amchart js -->
     <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
     <script src="https://www.amcharts.com/lib/3/serial.js"></script>
     <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
     <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
     <!-- all line chart activation -->
     <script src="{{ asset('assets/js/line-chart.js') }}"></script>
     <!-- all bar chart activation -->
     {{-- <script src="{{ asset('assets/js/bar-chart.js') }}"></script> --}}
     <!-- all pie chart -->
     {{-- <script src="assets/js/pie-chart.js"></script> --}}
     <!-- others plugins -->
     <script src="{{ asset('assets/js/plugins.js') }}"></script>
     <script src="{{ asset('assets/js/scripts.js') }}"></script>
@endpush


