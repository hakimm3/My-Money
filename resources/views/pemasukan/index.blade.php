@extends('layout.app')
@push('title-page')
    Income
@endpush
@push('breadcrumb')
    <li><a href="">Dashboard</a></li>
    <li><span>Income</span></li>
@endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Income
        @endslot
        @slot('boxBody')
            <x-admin.data-table-component id="table">
                @slot('title')
                    Data Income
                @endslot
                @slot('button')
                    <div class="col-6 mb-2">
                        <button class="btn btn-primary btn-sm" onclick="create()">Tambah</button>
                    </div>
                    <div class="col-2">

                    </div>
                    <div class="col-4">
                        <form>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="col-sm-4">
                                    <label class="sr-only" for="inlineFormInputName">Name</label>
                                    <select name="month" class="form-control">
                                        <option value="" @if (request()->month == '') selected @endif>All</option>
                                        <option value="january" @if (request()->month == 'january') selected @endif>January</option>
                                        <option value="february" @if (request()->month == 'february') selected @endif>February</option>
                                        <option value="march" @if (request()->month == 'march') selected @endif>March</option>
                                        <option value="april" @if (request()->month == 'april') selected @endif>April</option>
                                        <option value="may" @if (request()->month == 'may') selected @endif>May</option>
                                        <option value="june" @if (request()->month == 'june') selected @endif>June</option>
                                        <option value="july" @if (request()->month == 'july') selected @endif>July</option>
                                        <option value="august" @if (request()->month == 'august') selected @endif>August</option>
                                        <option value="september" @if (request()->month == 'september') selected @endif>September
                                        </option>
                                        <option value="october" @if (request()->month == 'october') selected @endif>October</option>
                                        <option value="november" @if (request()->month == 'november') selected @endif>November
                                        </option>
                                        <option value="december" @if (request()->month == 'december') selected @endif>December
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="sr-only" for="inlineFormInputGroupUsername">Year</label>
                                    <div class="input-group">
                                        <input type="year" name="year" value="{{ request()->year }}" class="form-control"
                                            id="inlineFormInputGroupUsername" placeholder="Year">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endslot
                @slot('columns')
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.box-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form id="form">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" id="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" id="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="text" name="amount" id="amount" class="form-control">
                </div>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@push('scripts')
    <script>
        let table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
        })

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('income.destroy', ':id') }}"
                    url = url.replace(':id', id)
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                timer: 2000,
                                timeProgressBar: true,
                                showConfirmButton: false,
                            })
                            table.ajax.reload()
                        }
                    })
                }
            })
        }
    </script>
@endpush
@include('pemasukan.create')
@include('pemasukan.edit')
