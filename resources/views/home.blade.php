@extends('layout.app')
@push('title-page')
    Dashboard
@endpush
@push('breadcrumb')
    <li><span>Dashboard</span></li>
@endpush

@section('content')
    <div class="row justify-content-end my-4">
        <div class="col-sm-12 col-md-4">
            <form>
                <div class="form-row align-items-center justify-content-end">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date" name="date">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card">
                <div class="seo-fact sbg2">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i>Pemasukan Bulan Ini</div>
                        <h2>{{ $incomeThisMonth }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card">
                <div class="seo-fact sbg3">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i>Pengeluaran Bulan Ini</div>
                        <h2>{{ $totalBulanIni }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card">
                <div class="seo-fact sbg4">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i>Balance</div>
                        <h2>{{ $balanceThisMonth }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    @include('dashboard.bar-chart-category')
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    @include('dashboard.line-chart')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('input[name="date"]').daterangepicker();
    </script>
@endpush
