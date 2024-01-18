@push('js')
    <script>
        function edit(id) {
            // $('#form')[0].reset()
            let url = "{{ route('spending.edit', ':id') }}"
            url = url.replace(':id', id)

            $.ajax({
                url: url,
                type: 'GET',
                dataType: "JSON",
                success: function(response) {
                    $('#id').val(response.data.id)
                    $('#date-update').val(response.data.date)
                    $('#description-update').val(response.data.description)
                    $('#category-update').val(response.data.category_id).change()
                    $('#amount-update').val(response.data.amount)
                    // showDrawer("drawer-update-product-default")
                },
                error: function(response) {
                    toastr.error(response)
                }
            })
        }


        // delete
        let item_id = null
        $("#deleteButton").click(function() {
            item_id = $(this).data('id')
        })

        function performDelete() {
            let url = "{{ route('spending.destroy', ':id') }}"
            url = url.replace(':id', item_id)

            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    toastr.success(response.message)
                    setTimeout(function() {
                        window.location.reload()
                    }, 1000);
                },
                error: function(response) {
                    toastr.error(response)
                }
            })
        }
    </script>
@endpush
