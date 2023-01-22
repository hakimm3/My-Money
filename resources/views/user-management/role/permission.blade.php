@extends('layout.app')
@push('title-page')
    Role Permission Setting
@endpush

@push('breadcrumb')
    <li><a href="">Dashboard</a></li>
    <li><a href="{{ route('user-management.role.index') }}">Role List</a></li>
    <li><span>Role Permission Setting</span></li>
@endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Role Permission Setting
        @endslot
        @slot('boxBody')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input type="text" class="form-control" value="{{ $role->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check-all"> Check All
                                </label>
                            </div>
                        </div>
                        <form action="{{ route('user-management.set-role-permission', Crypt::encrypt($role->id)) }}"
                            method="post">
                            @csrf
                            @foreach ($permission as $key => $perm)
                                <table class="table table-striped">
                                    <thead style="background-color: #4b84e0; color: white;"">
                                        <th class="text-uppercase" colspan="{{ $perm->count() }}">{{ $key }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($perm as $action)
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" value="{{ $action->id }}"
                                                            @if (in_array(
                                                                    $action->id,
                                                                    $role->permissions()->pluck('id')->toArray())) checked @endif>
                                                        {{ $action['action'] }}
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                            <button type="submit" class="btn btn-outline-primary">Save</button>
                            <a href="{{ route('user-management.role.index') }}"
                                class="btn btn-outline-secondary mr-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        @endslot
    </x-admin.box-component>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#check-all').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endpush
