@extends('layouts.admin')

@section('title','Final Account')

@section('style')
<link href="{{asset('assets/template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

{{-- <div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('sub-accounts.index')}}">All Sub Accounts</a></li>
        </ol>
    </div>
</div>
<!-- row --> --}}



<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-0">
                        <div class="col-6 text-right">
                            <h4 class="card-title">All Final Accounts</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".addsubaccount" onclick="initializeSelect2(), transactionSelect2()">Add new +</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Opening Date</th>
                                    <th>Sub Accounts</th>
                                    <th>Final Account </th>
                                    <th>Transaction Type</th>
                                    <th>Opening Balance</th>
                                    <th class="text-right w-25">Action</th>  
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($final_accounts as $key=> $final_account)
                                <tr>

                                    <td>{{++$key}}</td>
                                    <td>{{date('d/m/y', strtotime($final_account->date))}}</td>
                                    <td>{{$final_account->levelThree->title}}</td>
                                    <td>{{$final_account->title}}</td>
                                    <td>{{ucwords($final_account->transaction_type)}}</td>
                                    <td>{{number_format($final_account->opening_balance)}}</td>
                                    <td class="text-right">
                                    <button class="btn btn-info text-white" data-toggle="modal" data-target=".updateSubaccount" onclick="editResource('{{ route('final_account.edit',  $final_account->id) }}','.updateModalSubaccount')">Update</button> 
                                    <button class="btn btn-danger" onclick="commonFunction(true,'{{ route('final_account.destroy',$final_account->id) }}','{{route('final_account.index')}}','delete','Are you sure you want to delete?','');">Delete</button>
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



<!--Add Finalaccount modal start-->

<div class="modal fade addsubaccount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Final Accounts</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="form-validation my-5">
                    <form class="form-valide" id="create-form">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label px-0" for="val-account">Sub Accounts<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select class="form-control searchableSelect" id="val-account" name="level_three_id">
                                    <option value="" disabled selected>Select Sub Accounts</option>
                                    @foreach ($level_three as $account)
                                    <option value="{{str_pad($account->code, 2, '0', STR_PAD_LEFT)}}">{{$account->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label px-0" for="val-title">Final Accounts<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="val-title" name="title" placeholder="Enter Final Accounts..">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label px-0" for="opening-balance">Opening Balance<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="row m-0">
                                    <div class="col-6 pl-0">
                                        <input type="text" class="form-control" id="opening-balance" value="0" name="opening_balance" placeholder="Enter Opening Balance.." maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" data-val="0" data-common="common" onkeyup="getValue(this)">
                                    </div>
                                    <div class="col-6 pr-0">
                                        <select class="form-control searchableSelectTransaction" id="transaction-type" name="transaction_type">
                                            <option value="" disabled selected>Select Debit/Credit</option>
                                            <option value="debit">Debit</option>
                                            <option value="credit">Credit</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label px-0" for="opening-date">Opening Date<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" id="opening-date" name="opening_date" placeholder="dd/mm/yy" onkeyup="date_reformat_dd(this);" onkeypress="date_reformat_dd(this);" onpaste="date_reformat_dd(this);" autocomplete="off" type="text">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success text-white" onclick="commonFunction(false,'{{ route('final_account.store') }}','{{route('final_account.index')}}','post','','create-form');">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Add subaccount modal start-->


@endsection


 <!--Update account modal start-->

 <div class="modal fade updateSubaccount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content updateModalSubaccount">
            
        </div>
    </div>
</div>
<!--Update account modal start-->



@section('script')
    <script src="{{asset('assets/template/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>

    <script>
        function transactionSelect2(){
            $('.searchableSelectTransaction').select2({dropdownParent: $('.searchableSelectTransaction').parent()});
        }

    </script>
@endsection
