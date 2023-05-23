@push('scripts')
    <script>
        function create(){
            $('#form').trigger('reset');
            $('#modal-form').modal('show');
            $('.modal-title').text('Create Role');
            method = 'store';
        }

        function store(){
            let id = $('#id').val();
            let name = $('#name').val();

            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data Added Successfully';
            if(method == 'updated'){
                message = 'Data Updated Successfully';
            }

            $.ajax({
                url: "{{ route('user-management.role.store') }}",
                type: "POST",
                data: {
                    id: id,
                    name: name
                },
                success: function(data){
                    $('#modal-form').modal('hide');
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message
                    });
                    table.ajax.reload();
                },
                error: function(data){
                    console.log(data);
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            })
        }
    </script>
@endpush