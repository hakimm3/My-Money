@push('scripts')
    <script>
        function edit(id){
            $('#form')[0].reset()
            $('.modal-title').text('Edit Kategori')
            method = 'update'
            let url = "{{ route('income-categories.edit', ':id') }}"
            url = url.replace(':id', id)

            $.get(url, function(data) {
                $('#id').val(data.data.id)
                $('#name').val(data.data.name)
                $('#status').val(data.data.status).change()
                $('#modal-form').modal('show');
            });
        }
    </script>
@endpush