<?php

namespace App\Http\Controllers;

use App\SubAccount;
use App\Account;
use App\FinalAccount;
use App\User;
use App\VoucherDetail;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use mysqli;
use Illuminate\Support\Facades\Session;


class TrialBalanceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $accounts = FinalAccount::select('id', 'title')->get();
        return view('admin.trialBalance.index', compact('accounts'));
    }

    // get trial balance of accounts
    // public function getTrialBalance(Request $request){
    //     $validations = Validator::make($request->all(), ['date' => 'required']);
    //     if ($validations->fails()) { return response()->json(['success' => false, 'message' => $validations->errors()]);}
    //     $subAccounts = SubAccount::all();
    //     $endDate = Carbon::createFromFormat('d / m / y', $request->date)->format('y-m-d');
    //     return response()->json(['success' => true, 'html' => view('admin.trialBalance.get_data',compact('subAccounts','endDate'))->render()]);
    // }

    public function getTrialBalance(Request $request){
    // $request->validate([
    //         'start_date' =>'required|date|date_format:"d/m/Y"',
    //         'end_date' => 'required|date|date_format:"d/m/Y"|after_or_equal:start_date',
    //     ]);

        $validations = Validator::make($request->all(), ['start_date' => 'required|date_format:d / m / y','end_date' => 'required|date_format:d / m / y|after_or_equal:start_date']);
        if ($validations->fails()) {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }
        $startDate = Carbon::createFromFormat('d / m / y', $request->start_date)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d / m / y', $request->end_date)->format('Y-m-d');
        $vouchers = VoucherDetail::where('final_account_id',$request->account)->whereBetween('date',[$startDate, $endDate])->orderBy('date','asc')->get();
        // dd(FinalAccount::where('level_three_id', 8)->get());
        $subAccounts = $request->account==null ? FinalAccount::all() : FinalAccount::where('id', $request->account)->get();
        // $subAccounts = FinalAccount::where('level_three_id',$request->account)->get();
        Session::put('key', $subAccounts);
        return response()->json(['success' => true, 'html' => view('admin.trialBalance.get_data',compact('vouchers','subAccounts','startDate','endDate'))->render()]);
    }

    public function checkPassword(Request $request){

        $validations = Validator::make($request->all(), ['password' => 'required']);
        if ($validations->fails()) { return response()->json(['success' => false, 'message' => $validations->errors()]);}

        if(Hash::check($request->password, Auth::user()->tb_password)){
            Session::put('Trial_Bal_Password_Check', 'This is check for password');
            return response()->json(['success' => true, 'message' => "Thanks for verification"]);
        }else{
            return response()->json(['success' => false, 'message' => ["Sorry! These credientials does not match with our record"]]);
        }
        // return $request->session()->has('TEST');
    }

    public function changePassword(Request $request){

        $validations = Validator::make($request->all(),[
            'old_password'=>'required',
            'new_password'=>['required','min:8','same:confirm_password'],

        ]);
        if($validations->fails())
        {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }
        else{
            if(Hash::check($request->old_password, Auth::user()->tb_password)){

                $password = User::find(Auth::user()->id);
                $password->tb_password = Hash::make($request->new_password);
                $password->save();
                return response()->json(['success' => true, 'message' => "Password has been changed successfully"]);
            }
            else{
                return response()->json(['success' => false, 'message' => ["Old Password is wrong"]]);
            }
        }
    }



}
