@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card mr-5" style="width: 18rem;">
                <img src="{{asset('assets/img/voucher.png')}}" height="150px" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Create Voucher</h5>
                    <p class="card-text"> <b>Facility to define multi vouchers types</b> Facility to make Acoount Management System Vouchers</p>
                    <a href="{{url('journal/create')}}" class="btn btn-primary">Create Voucher</a>
                </div>
            </div>
            <div class="card mr-5" style="width: 18rem;">
                <img src="{{asset('assets/img/chart.jpg')}}" height="150px"  class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Chart Of Account</h5>
                    <p class="card-text">A chart of accounts (COA) is an index of all the financial accounts in the general ledger of a company.</p>
                    <a href="{{url('coa')}}" class="btn btn-primary">Chart Of Account</a>
                </div>
            </div>
            <div class="card mr-5" style="width: 18rem;">
                <img src="{{asset('assets/img/Trial_balance.png')}}" height="150px" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Trial Balance</h5>
                    <p class="card-text">A statement that keeps a record of the final ledger balance of all accounts in a business</p>
                    <a href="{{url('trialBalance')}}" class="btn btn-primary">Trial Balance</a>
                </div>
            </div>
        </div>
    </div>
@endsection
