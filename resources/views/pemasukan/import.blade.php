    {{-- modal import --}}
    <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="modal-importLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-importLabel">Import Dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-import" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </form>
                    <a href="{{ asset('template/pengeluaran.xlsx') }}" class="btn btn-info btn-sm">Template</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-import">Import</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showModalImport() {
                $('#modal-import').modal('show');
            }

            $('#btn-import').click(function() {
                let form = $('#form-import')[0];
                let data = new FormData(form);

                // swal loading
                swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('income.import') }}',
                    method: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status) {
                            $('#modal-import').modal('hide');
                            table.ajax.reload();
                            swal.fire({
                                title: 'Success!',
                                text: res.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            swal.fire({
                                title: 'Error!',
                                text: res.message,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        let error = xhr.responseJSON.errors.file;
                        toastr.error(error, 'Error');
                    }
                })
            })
        </script>
    @endpush
