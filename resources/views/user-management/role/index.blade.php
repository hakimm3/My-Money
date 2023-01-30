@extends('layout.app')
@push('title-page')
    Role List
@endpush

@push('breadcrumb')
    <li><a href="">Dashboard</a></li>
    <li><span>Role List</span></li>
@endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Role List
        @endslot
        @slot('boxBody')
            <x-admin.data-table-component id="table">
                @slot('title')
                    Data Role
                @endslot
                @slot('button')
                    <button class="btn btn-primary btn-sm -bottom-3  mb-2" onclick="create()">Add Role</button>
                @endslot
                @slot('columns')
                    <th width="70%">Role Name</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>
    <x-admin.modal-form-component>
        @slot('modalBody')
            <form id="form">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="naem" id="name" class="form-control">
                    <input type="hidden" name="id" id="id">
                </div>
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@push('scripts')
    <script>
        let table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    name: 'name',
                    data: 'name'
                },
                {
                    name: 'action',
                    data: 'action',
                    searcable: false,
                    orderable: false
                },
            ]
        })
    </script>

    <script>
        function destroy(id){
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
                    let url = "{{ route('user-management.role.destroy', ":id") }}"
                    url = url.replace(':id', id)
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        success: function(data){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        },
                        error: function(data){
                            Swal.fire(
                                'Oops...',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    })
                }
            })
        }
    </script>
@endpush

@include('user-management.role.create')
@include('user-management.role.edit')

@if (session('success'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}"
            })
        </script>
        
    @endpush
@endif

