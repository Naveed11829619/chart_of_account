<?php

namespace App\Http\Controllers;

use App\FinalAccount;
use App\VoucherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Validator;


class FinalReportController extends Controller
{
    public function index(){
        
        $finalAccount = FinalAccount::select('id', 'title')->get();
        return view('admin.reports.final_report.index');
    }


    // get data for Final Account
    public function entriesBetweenDates(Request $request){
        $validations = Validator::make($request->all(), ['start_date' => 'required','end_date' => 'required|after_or_equal:start_date']);
        if ($validations->fails()) { return response()->json(['success' => false, 'message' => $validations->errors()]);}
        $vouchers = VoucherDetail::whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->orderBy('date','asc')->get();
        $totalDebit = VoucherDetail::where('final_account_id',$request->account)->whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->get();
        $totalCredit = VoucherDetail::where('final_account_id',$request->account)->whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->get();
        $subAccounts = FinalAccount::all();
        $startDate = Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d');
        $endDate = Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d');
        $sumOfDebit = VoucherDetail::select('debit_amount')->whereBetween('date',[$startDate,$endDate])->sum('debit_amount');
        $sumOfCredit = VoucherDetail::select('credit_amount')->whereBetween('date',[$startDate,$endDate])->sum('credit_amount');
        // dd($vouchers);
        return response()->json(['success' => true, 'html' => view('admin.reports.final_report.get_data',compact('sumOfDebit','sumOfCredit','vouchers','totalDebit','totalCredit','subAccounts','endDate','startDate'))->render()]);
    }
}
