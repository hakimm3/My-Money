@extends('layout.app')
@push('title-page')
    User Management
@endpush
@push('breadcrumb')
    <li class="breadcrumb-item active">User Management</li>
@endpush
@section('content')
    <x-admin.box-component>
        @slot('title')
            User List
        @endslot
        @slot('boxBody')
            <x-admin.data-table-component id="table">
                @slot('title')
                    Data User
                @endslot
                @slot('button')
                    <button class="btn btn-primary btn-sm -bottom-3  mb-2" onclick="create()">Add User</button>
                @endslot
                @slot('columns')
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>
    <x-admin.modal-form-component>
        @slot('modalBody')
            <form id="form">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="id" id="id">
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
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'roles', name: 'roles'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush

@include('user-management.user.create')
@include('user-management.user.edit')