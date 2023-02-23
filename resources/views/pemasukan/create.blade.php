@push('scripts')
    <script>
        $(function() {
            $('#amount').keyup(function(e) {
                $(this).val(format($(this).val()));
            });
        })
        let format = function(num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

        $('#category').select2({
            placeholder: 'Pilih Kategori',
            allowClear: true,
            width: '100%',
            theme: 'classic'
        });

        function create() {
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Tambah Pemasukan');
            $('#form')[0].reset();
            method = 'store';
        }

        function store() {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data berhasil disimpan';
            if (method == 'update') {
                message = 'Data berhasil diubah';
            }

            $.ajax({
                url: "{{ route('income.store') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: $('#date').val(),
                    description: $('#description').val(),
                    category_id: $('#category').find(':selected').val(),
                    amount: Number($('#amount').val().replace(/,/g, '')),
                    user_id: $('#user_id').val(),
                    id : $('#id').val()
                },
                success: function(data) {
                    $('#modal-form').modal('hide');
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                    table.ajax.reload();
                    
                    // sweet alert for 3 seconds
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })
                },
                error: function(data) {
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);

                    var error_message = "";
                    error_message += "<ul>";
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += "<li>" + value + "</li>";
                    });
                    error_message += "</ul>";
                //    sweet alert for 3 seconds
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: error_message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })
                }
            })
        }
    </script>
@endpush
