@push('scripts')
    <script>
        $(function() {
            $("#amount").keyup(function(e) {
                $(this).val(format($(this).val()));
            });
        });
        var format = function(num) {
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
    </script>

    <script>
        function create() {
            $('#modal-form').modal('show');
            $('#modal-form').find('.modal-title').text('Tambah Pengeluaran');
            $('#form')[0].reset();
            method = 'store'
        }

        function store() {
            let id = $('#id').val();
            let date = $('#date').val();
            let description = $('#description').val();
            let category = $('#category').find(':selected').val();
            let amount = Number($('#amount').val().replace(/,/g, ''));

            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);

            let message = 'Data berhasil disimpan';
            if (method == 'update') {
                message = 'Data berhasil diubah';
            }

            $.ajax({
                url: "{{ route('spending.store') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    date: date,
                    description: description,
                    category_id: category,
                    amount: amount,
                    user_id: "{{ Auth::user()->id }}",
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
