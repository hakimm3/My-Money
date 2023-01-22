<a href="{{ route('user-management.role.show', Crypt::encrypt($id)) }}" class="btn btn-outline-warning btn-sm mr-2"><i class="ti-settings"></i> Permissions</a>

<button class="btn btn-outline-info btn-sm mr-2" onclick="edit({{ $id }})" data-toggle="tooltip" data-placement="top"
    title="Edit">
    <i class="ti-pencil"></i>
</button>

<button class="btn btn-outline-danger btn-sm mr-2" onclick="destroy({{ $id }})" data-toggle="tooltip" data-placement="top"
    title="Hapus">
    <i class="ti-trash"></i>
</button>
