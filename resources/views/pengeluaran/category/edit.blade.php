@push('scripts')
    <script>
        function edit(id){
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Edit Kategori');
            $('#form')[0].reset();
            method = 'update'
            let url = "{{ route('spending-categories.edit', ":id") }}"
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#id').val(data.data.id);
                    $('#name').val(data.data.name);
                    $('#status').val(data.data.status);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
@endpush