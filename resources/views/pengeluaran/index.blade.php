@extends('layout.app')

    @push('title-page')
        Pengeluaran
    @endpush

    @push('breadcrumb')
        <li><a href="">Dashboard</a></li>
        <li><span>Pengeluaran</span></li>
    @endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Pengeluaran
        @endslot

        @slot('boxBody')
            <x-admin.data-table-component id="table">
                @slot('title')
                   Data Pengeluaran
                @endslot
                
                @slot('button')
                   <div class="col-6 mb-2">
                    <a href="" class="btn btn-primary btn-sm">Tambah</a>
                   </div>
                @endslot

                @slot('columns')
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endpush