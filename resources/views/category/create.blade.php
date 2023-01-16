@push('css')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
    <script>
        function create(){
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Tambah Kategori');
            $('#form')[0].reset();
            method = 'store'
        }

        function store(){
            let id = $('#id').val();
            let name = $('#name').val();
            let status = $('#status').find(':selected').val();

            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data berhasil disimpan';
            if (method == 'update') {
                message = 'Data berhasil diubah';
            }

            $.ajax({
                url: "{{ route('categories.store') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    name: name,
                    status: status,
                },
                success: function (data) {
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
                error: function (data) {
                    console.log('Error:', data);
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }
    </script>
@endpush