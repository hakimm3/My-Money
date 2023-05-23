@push('scripts')
    <script>
        function modal_import() {
            $('#modal-import').modal('show');
            $('#modal-import').find('.modal-title').text('Import Pengeluaran');
            $('#form-import')[0].reset();
        }

        $('#btn-import').on('click', function(){
            // disable button
            $('#btn-import').text('Importing...');
            $('#btn-import').attr('disabled', true);

            // sweet alert loading
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            })


            $.ajax({
                url: "{{ route('pengeluaran.import') }}",
                type: "POST",
                dataType: "JSON",
                data: new FormData($('#form-import')[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-import').modal('hide');
                    $('#btn-import').text('Import');
                    $('#btn-import').attr('disabled', false);
                    // sweet alert success message dalam 1.5 detik
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diimport',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    table.ajax.reload();
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
                        title: 'Gagal',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#btn-import').text('Import');
                    $('#btn-import').attr('disabled', false);

                }
            })
        })
    </script>
@endpush
