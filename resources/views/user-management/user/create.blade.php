@push('scripts')
    <script>
        function create(){
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Tambah Pengguna');
            $('#form')[0].reset();
            method = 'store'
        }

        function store(){
            let id = $('#id').val();
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
            let role = $('#role').find(':selected').val();

            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data berhasil disimpan';
            let url = "{{ route('user-management.user.store') }}";
            let type = "POST";
            if (method == 'update') {
                message = 'Data berhasil diubah';
                url = "{{ route('user-management.user.update', ":id") }}";
                url = url.replace(':id', id);
                type = "PUT";
            }

            $.ajax({
                url: url,
                type: type,
                dataType: "JSON",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    role: role,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#modal-form').modal('hide');
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: message,
                    })
                    $('#table').DataTable().ajax.reload();
                },
                error: function(data) {
                    var error_message = "";
                    error_message += "<ul>";
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += "<li>" + value + "</li>";
                    });
                    error_message += "</ul>";
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Peringatan',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }
            })
        }
    </script>
@endpush