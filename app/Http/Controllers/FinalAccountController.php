<?php

namespace App\Http\Controllers;

use App\FinalAccount;
use App\LevelThree;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FinalAccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:view-sub-categories', ['only' => ['index']]);
        // $this->middleware('permission:create-sub-category', ['only' => ['create', 'store']]);
        // $this->middleware('permission:update-sub-category', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete-sub-category', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $final_accounts = FinalAccount::with('levelThree')->get();
        $level_three = LevelThree::all();
        return view('admin.final_account.index',compact('level_three','final_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::all();
        return view('admin.subAccounts.create',compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validations = Validator::make($request->all(),[
            'title'=>'required || unique:final_accounts,title,NULL,id,deleted_at,NULL',
            'level_three_id'=>'required',
            'opening_date'=>'required',
            'transaction_type'=>'required',
            'opening_balance'=>'required',
        ]);

        if($validations->fails())
        {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }


        $final_account = new FinalAccount();
        $final_account->title = $request->title;
        $final_account->level_three_id = $request->level_three_id;
        $final_account->date = Carbon::createFromFormat('d / m / y', $request->opening_date)->format('y-m-d');
        $final_account->transaction_type = $request->transaction_type;
        $final_account->opening_balance = str_replace(',','',$request->opening_balance);
        $final_account->created_by = Auth::user()->id;
        if($final_account->save()){
            $final_account->code = str_pad($final_account->id, 9, '0', STR_PAD_LEFT);
            $final_account->save();
            return response()->json(['success' => true, 'message' =>'Level 3 Accounts has been added successfully', 'data'=>$final_account]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subaccount  $subaccount
     * @return \Illuminate\Http\Response
     */
    public function show(SubAccount $subAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subaccount  $subaccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounts = LevelThree::all();
        $final_account = FinalAccount::where('id',$id)->first();
        return view('admin.final_account.edit',compact('accounts','final_account'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LevelThree  $LevelThree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinalAccount $finalAccount)
    {
        
        $validations = Validator::make($request->all(),[
            'title'=>'required || unique:final_accounts,title,'.$finalAccount->id,
            'level_three_id'=>'required',
            'opening_date'=>'required',
            'transaction_type'=>'required',
            'opening_balance'=>'required',

        ]);
        if($validations->fails())
        {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }

        $finalAccount->title = $request->title;
        $finalAccount->level_three_id = $request->level_three_id;
        $finalAccount->date = Carbon::createFromFormat('d / m / y', $request->opening_date)->format('y-m-d');
        $finalAccount->transaction_type = $request->transaction_type;
        $finalAccount->opening_balance = str_replace(',','',$request->opening_balance);
        $finalAccount->created_by = Auth::user()->id;
        if($finalAccount->save()){
           
            return response()->json(['success' => true, 'message' =>'level 3 Accounts has been updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubAccount  $subaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($final_account)
    {
        // if(!SubAccount::where('id', $subAccount)->whereHas('get_debit_subaccount')->exists() && !SubAccount::where('id', $subAccount)->whereHas('get_credit_subaccount')->exists()){
        //     if(SubAccount::where('id', $subAccount)->delete()){
        //         return response()->json(['success' => true, 'message' =>'Sub Account has been deleted successfully']);
        //     }
        // }else{
        //     return response()->json(['success' => false , 'redirect'=>false , 'message' =>'Please delete vouchers first ']);
        // }

        if(FinalAccount::where('id',$final_account)->delete()){
            return response()->json(['success' => true, 'message' =>'Final Account has been deleted successfully']);
        }
    }
}
