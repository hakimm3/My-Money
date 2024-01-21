@extends('layout.app')
@section('content')
<div class="px-4 pt-6 2xl:px-0">
    <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <!-- Main widget -->
        @include('dashboard.main-widget')

        <!--Tabs widget -->
        @include('dashboard.tabs-widget')
    </div>
    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
        @include('dashboard.tabs-spending')
        @include('dashboard.tabs-incomes')
        @include('dashboard.tabs-backup')
    </div>
</div>
@endsection