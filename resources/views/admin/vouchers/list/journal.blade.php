@extends('layouts.admin')
@section('title', 'Voucher List')


@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-6 text-right">
                                <h4 class="card-title">All Vouchers</h4>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('journal.create') }}">
                                    <button type="button" class="btn btn-primary">
                                        Add new +
                                    </button>
                                </a>
                            </div>
                        </div>
                        {{-- <form action="{{route('journal.index')}}" id="filterForm"> --}}
                        <div class="ml-1">
                            <div class="row">
                                <div class="col-lg-3 ml-4 px-0">
                                    <label class="col-lg-12 col-form-label px-0" for="val-start_date">Voucher Type<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control searchableSelect filter" onchange="selectVoucherType(this)"
                                        name="voucher_type" id="val-account">
                                        {{-- <option value="Voucher Type" disabled selected>Voucher Type</option> --}}
                                        <option value="All" class="Vtype">All Voucher</option>
                                        <option value="Journal Voucher" class="Vtype">Journal Voucher</option>
                                        <option value="Cash Payment Voucher" class="Vtype">Cash Payment Voucher</option>
                                        <option value="Cash Receipt Voucher" class="Vtype">Cash Receipt Voucher</option>
                                        <option value="Bank Payment Voucher" class="Vtype">Bank Payment Voucher</option>
                                        <option value="Bank Receipt Voucher" class="Vtype">Bank Receipt Voucher</option>
                                    </select>
                                </div>
                                {{-- -------------------------- Start Date Filter Form --------------------------- --}}

                                <form action="{{ url('journalDate') }}" method="post" class="row">
                                    @csrf
                                    <div class="col-5">
                                        <div class="form-group m-0 align-items-center">
                                            <label class="col-lg-12 col-form-label px-0" for="val-start_date">Start
                                                date<span class="text-danger">*</span></label>
                                            <div class="col-lg-12 px-0">
                                                <input name="start_date" class="form-control" placeholder="dd/mm/yyyy"
                                                    onkeyup="date_reformat_dd(this);" onkeypress="date_reformat_dd(this);"
                                                    onpaste="date_reformat_dd(this);" autocomplete="off" type="date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="form-group row m-0 align-items-center">
                                            <label class="col-lg-12 col-form-label px-0" for="val-end_date">End date<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12 px-0">
                                                <input name="end_date" class="form-control" placeholder="dd/mm/yyyy"
                                                    onkeyup="date_reformat_dd(this);" onkeypress="date_reformat_dd(this);"
                                                    onpaste="date_reformat_dd(this);" autocomplete="off" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-4 float-end">
                                        <div class="form-group mt-2 float-end">
                                            <button type="submit" class="btn btn-primary">Filter by Date</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- ------------------------------------End Date Filter Form----------------------------------------------- --}}

                        </div>




                        <div class="d-flex justify-content-end px-3 mt-4">
                            <a class="btn btn-success text-white" href="{{ route('journalReport') }}">Export to PDF</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Voucher Id</th>
                                        <th>Date</th>
                                        <th>Voucher Type</th>
                                        <th>Final account</th>
                                        <th>Naration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th class="text-right">Delete</th>
                                    </tr>
                                </thead <tbody>

                                @foreach ($vouchers as $key => $voucherDetail)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <a href="{{ route('journal.edit', $voucherDetail->voucher->id) }}">
                                                {{ $voucherDetail->voucher_id }}
                                            </a>
                                        </td>
                                        <td>{{ date('d/m/y', strtotime($voucherDetail->date)) }}</td>
                                        <th>{{ ucwords(str_replace('_', ' ', $voucherDetail->voucher->voucher_type)) }}</th>
                                        <td>
                                            <a href="{{ route('partyAccount') }}">
                                                {{ $voucherDetail->finalAccount->title }}
                                            </a>
                                        </td>
                                        <td>{{ $voucherDetail->product_narration }}</td>
                                        {{-- Code for Debit start --}}
                                        @if ($voucherDetail->entry_type == 'debit')
                                            <td>{{ number_format($voucherDetail->debit_amount) }}</td>
                                        @else
                                            <td>0.00</td>
                                        @endif
                                        {{-- Code for Debit start --}}

                                        {{-- Code for Credit start --}}
                                        @if ($voucherDetail->entry_type == 'credit')
                                            <td>{{ number_format($voucherDetail->credit_amount) }}</td>
                                        @else
                                            <td>0.00</td>
                                        @endif
                                        {{-- Code for Credit start --}}

                                        <td class="text-right d-flex">
                                            
                                            <a class="btn btn-info text-white btn-sm mr-2" href="{{ url('printvoucher/'. $voucherDetail->voucher->id) }}">Print</a>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="commonFunction(true,'{{ route('journal.destroy', $voucherDetail->voucher->id) }}','{{ route('journal.index') }}','delete','Are you sure you want to delete?','');">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        function selectVoucherType(elem) {
            if ($(elem).val() != "All") {
                $(document).find("input[type='search']").val($(elem).val());
            } else {
                $(document).find("input[type='search']").val('');
            }
            $(document).find("input[type='search']").trigger("keyup");
        }
    </script>
    <script src="{{ asset('assets/template/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/template/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>


@endsection
