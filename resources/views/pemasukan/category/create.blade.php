@push('scripts')
    <script>
        function create() {
            $('#form')[0].reset()
            $('.modal-title').text('Tambah Kategori')
            method = 'store'
            $('#modal-form').modal('show');
        }

        function store() {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data Saved Successfully';
            if (method == 'update') {
                message = 'Data Updated Successfully';
            }

            $.ajax({
                url: "{{ route('income-categories.store') }}",
                type: "POST",
                dataType: "JSON",
                data: $('#form').serialize(),
                success: function(data) {
                    $('#modal-form').modal('hide');
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                    table.draw();
                    Swal.fire({
                        icon: 'success',
                        title: message,
                        showConfirmButton: false,
                        timer: 1500
                    })
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
            });
        }
    </script>
@endpush
