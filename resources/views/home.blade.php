@extends('layout.app')
@push('title-page')
    Dashboard
@endpush
@push('breadcrumb')
    <li><span>Dashboard</span></li>
@endpush

@section('content')
    <div class="row justify-content-end my-4">
        <div class="col-sm-12 col-md-8">
            <form method="GET">
                <div class="form-row align-items-center justify-content-end">
                    <div class="col-sm-4">
                        <select name="category_id" id="category" class="form-control">
                            <option value="">All Category</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{( request()->category_id ==  $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
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
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Average Eat / Month in  Last 1 Year</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{  'Rp. '.number_format($averageEat, 0, ',', '.'); }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Average Kebutuhan Dasar / Month in  Last 1 Year</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{  'Rp. '.number_format($averageKebutuhanDasar, 0, ',', '.'); }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Next Backup</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{ $nextBackup }}</h4>
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
    <link rel="stylesheet" href="{{ asset('/assets/libs/css/style.css') }}">
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('input[name="date"]').daterangepicker();
        @if (request()->date)
            $('input[name="date"]').val('{{ request()->date }}');
        @endif
    </script>
@endpush
