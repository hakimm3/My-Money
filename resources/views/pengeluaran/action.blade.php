@can('update-pengeluaran')
    <button class="btn btn-outline-primary btn-sm mr-2" onclick="edit('{{ $id }}')" data-toggle="tooltip"
        data-placement="top" title="Edit">
        <i class="ti-pencil"></i>
    </button>
@endcan
@can('delete-pengeluaran')
    <button class="btn btn-outline-danger btn-sm" onclick="destroy('{{ $id }}')" data-toggle="tooltip"
        data-placement="top" title="Delete">
        <i class="ti-trash"></i>
    </button>
@endcan
