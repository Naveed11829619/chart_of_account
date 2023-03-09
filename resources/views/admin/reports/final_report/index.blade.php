@extends('layouts.admin')

@section('title', 'Final Account Report')

@section('style')

@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-6 text-right">
                                <h4 class="card-title">Final Account Report</h4>
                            </div>
                        </div>
                        <form method="post" id="create-form">
                            @csrf
                            <div class="row mx-0 mb-5 align-items-end">
                                <div class="col-3">
                                    <div class="form-group row m-0 align-items-center">
                                        <label class="col-lg-12 col-form-label px-0" for="val-start_date">Final Account<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12 px-0">
                                            <input type="text" class="form-control" value="Final Account" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group row m-0 align-items-center">
                                        <label class="col-lg-12 col-form-label px-0" for="val-start_date">Start date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12 px-0">
                                            <input name="start_date" id="val-start_date" class="form-control"
                                                placeholder="dd/mm/yy" onkeyup="date_reformat_dd(this);"
                                                onkeypress="date_reformat_dd(this);" onpaste="date_reformat_dd(this);"
                                                autocomplete="off" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group row m-0 align-items-center">
                                        <label class="col-lg-12 col-form-label px-0" for="val-end_date">End date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12 px-0">
                                            <input name="end_date" id="val-end_date" class="form-control"
                                                placeholder="dd/mm/yy" onkeyup="date_reformat_dd(this);"
                                                onkeypress="date_reformat_dd(this);" onpaste="date_reformat_dd(this);"
                                                autocomplete="off" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <button type="button" class="btn btn-primary"
                                        onclick="commonFunctionForAllRequest(true,false,'.trialBalancePortion','{{ route('getFinalAccountData') }}','','post','','create-form');">Create
                                        Report</button>
                                </div>
                        </form>
                        <div class="trialBalancePortion">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
