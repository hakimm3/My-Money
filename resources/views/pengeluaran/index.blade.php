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
                        <button class="btn btn-primary btn-sm my-2" onclick="create()">Tambah</button>
                        <button class="btn btn-info btn-sm my-2" onclick="modal_import()">Import</button>
                        <a href="{{ route('pengeluaran.export') }}" class="btn btn-warning my-2">Export</a>
                    </div>
                    <div class="col-2">

                    </div>
                    <div class="col-4">
                        <form>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="dates">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endslot

                @slot('columns')
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Event</th>
                    <th>Amount</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form id="form">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" id="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" id="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Event</label>
                    <select name="event" id="event" class="form-control">
                        <option value="">Pilih event jika ada</option>
                        @foreach ($events as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="text" name="amount" id="amount" class="form-control">
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('input[name="dates"]').daterangepicker();
        // disable button submit
        // $('#btnSubmit').prop('disabled', true);
    </script>c
@endpush


@push('scripts')
    <script>
        let table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            language: {
                'paginate': {
                    'previous': '<span class="fa fa-arrow-left"></span>',
                    'next': '<span class="fa fa-arrow-right"></span>'
                }
            },
            ajax: "",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false,
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: false,
                },
                {
                    data: 'category',
                    name: 'category',
                    orderable: false,
                },
                {
                    data: 'event',
                    name: 'event',
                    orderable: false,
                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    </script>
@endpush

@include('pengeluaran.create')
@include('pengeluaran.edit')
@include('pengeluaran.import')

@push('scripts')
    <script>
        function destroy(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang di hapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('spending.destroy', ':id') }}"
                    url = url.replace(':id', id)
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil di hapus.',
                                'success'
                            )
                            table.ajax.reload()
                        }
                    })
                }
            })
        }
    </script>
@endpush
