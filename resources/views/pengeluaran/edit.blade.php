@push('scripts')
    <script>
        function edit(id) {
            $('#form')[0].reset()
            $('.modal-title').text('Edit Pengeluaran')
            method = 'update'
            let url = "{{ route('pengeluaran.edit', ':id') }}"
            url = url.replace(':id', id)

            $.get(url, function(data) {
                $('#id').val(data.data.id)
                $('#date').val(data.data.date)
                $('#description').val(data.data.description)
                $('#category').val(data.data.category_id).change()
                $('#amount').val(data.data.amount)
                $('#modal-form').modal('show');
            });
        }
    </script>
@endpush
