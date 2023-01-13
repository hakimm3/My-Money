@extends('layout.app')
@push('title-page')
    Dashboard
@endpush
@push('breadcrumb')
    <li><span>Dashboard</span></li>
@endpush

@section('content')
    <div class="row justify-content-end my-4">
        <div class="col-4">
            <form>
                <div class="form-row align-items-center justify-content-end">
                    <div class="col-sm-4">
                        <label class="sr-only" for="inlineFormInputName">Name</label>
                        <select name="month" class="form-control">
                            <option value="" @if (request()->month == '') selected @endif>All</option>
                            <option value="january" @if (request()->month == 'january') selected @endif>January</option>
                            <option value="february" @if (request()->month == 'february') selected @endif>February</option>
                            <option value="march" @if (request()->month == 'march') selected @endif>March</option>
                            <option value="april" @if (request()->month == 'april') selected @endif>April</option>
                            <option value="may" @if (request()->month == 'may') selected @endif>May</option>
                            <option value="june" @if (request()->month == 'june') selected @endif>June</option>
                            <option value="july" @if (request()->month == 'july') selected @endif>July</option>
                            <option value="august" @if (request()->month == 'august') selected @endif>August</option>
                            <option value="september" @if (request()->month == 'september') selected @endif>September</option>
                            <option value="october" @if (request()->month == 'october') selected @endif>October</option>
                            <option value="november" @if (request()->month == 'november') selected @endif>November</option>
                            <option value="december" @if (request()->month == 'december') selected @endif>December</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Year</label>
                        <div class="input-group">
                            <input type="year" name="year" value="{{ request()->year }}" class="form-control"
                                id="inlineFormInputGroupUsername" placeholder="Year">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
        <div class="col-lg-7 mt-2">
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
