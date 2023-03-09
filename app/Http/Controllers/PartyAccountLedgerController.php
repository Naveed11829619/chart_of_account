<?php

namespace App\Http\Controllers;

use App\FinalAccount;
use Illuminate\Http\Request;
use Validator;
use App\Voucher;
use App\VoucherDetail;
use App\SubAccount;
use Carbon\Carbon;

class PartyAccountLedgerController extends Controller
{
    public function index()
    {
        $subAccounts = FinalAccount::select('id', 'title')->get();
        return view('admin.reports.partyAccountLedger.index',compact('subAccounts'));
    }

    // get data for trial balance
    public function entriesBetweenDates(Request $request){
        $validations = Validator::make($request->all(), ['final_account'=>'required','start_date' => 'required','end_date' => 'required|after_or_equal:start_date']);
        if ($validations->fails()) { return response()->json(['success' => false, 'message' => $validations->errors()]);}
        $vouchers = VoucherDetail::where('final_account_id',$request->final_account)->whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->orderBy('date','asc')->get();
        $totalDebit = VoucherDetail::where('final_account_id',$request->final_account)->whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->sum('debit_amount');
        $totalCredit = VoucherDetail::where('final_account_id',$request->final_account)->whereBetween('date',[Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d'), Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d')])->sum('credit_amount');
        $subAccount = FinalAccount::where('id', $request->final_account)->first();
        $startDate = Carbon::createFromFormat('d / m / y', $request->start_date)->format('y-m-d');
        $endDate = Carbon::createFromFormat('d / m / y', $request->end_date)->format('y-m-d');
        return response()->json(['success' => true, 'html' => view('admin.reports.partyAccountLedger.get_data',compact('vouchers','totalDebit','totalCredit','subAccount','endDate','startDate'))->render()]);
    }
}
