@can('update-pengeluaran')
    <x-drawer.button-component
        id="updateProductButton"
        drawerId="drawer-update"
        iconClass="fa-regular fa-pen-to-square" 
        text="Update" 
        color="primary">
        <x-slot name="additionalAttributes">
            onclick="edit('{{ $model->id }}')"
        </x-slot>
    </x-drawer.button-component>
@endcan
@can('delete-pengeluaran')
    <x-drawer.button-component
     id="deleteButton"
     drawerId="drawer-delete"
     iconClass="fa-solid fa-trash" 
     text="Delete" 
     color="red">
        <x-slot name="additionalAttributes">
            data-id = "{{ $model->id }}"
        </x-slot>
    </x-drawer.button-component>
@endcan
