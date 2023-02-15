@extends('layout.app')
@push('title-page')
    Categories
@endpush
@push('breadcrumb')
    <li><a href="">Dashboard</a></li>
    <li><span>Categories</span></li>
@endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Categories
        @endslot
        @slot('boxBody')
            <x-admin.data-table-component id="table">
                @slot('title')
                    Data Categories
                @endslot
                @slot('button')
                    <button class="btn btn-primary btn-sm mb-2" onclick="create()">Tambah</button>
                @endslot
                @slot('columns')
                    <th>Name</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form id="form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@push('scripts')
    <script>
        let table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = '{{ route('income-categories.destroy', ':id') }}'
                    url = url.replace(':id', id)
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your file has been deleted.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.ajax.reload();
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error!',
                                'Your file has been error.',
                                'error'
                            )
                        }
                    })
                }
            })
        }
    </script>
@endpush
@include('pemasukan.category.create')
@include('pemasukan.category.edit')
