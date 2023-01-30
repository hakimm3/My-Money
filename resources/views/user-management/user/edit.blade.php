@push('scripts')
    <script>
        function edit(id){
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Edit Pengguna');
            $('#form')[0].reset();
            method = 'update'
            let url = "{{ route('user-management.user.edit', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.roles[0].id);
                },
                error: function(data){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Data tidak ditemukan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
        }
    </script>
@endpush