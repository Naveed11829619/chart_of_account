<?php

namespace App\Http\Controllers;

use App\LevelThree;
use App\SubAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LevelThreeController extends Controller
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
        $level3 = LevelThree::with('subAccount')->get();
        $subAccounts = SubAccount::all();
        return view('admin.level_three.index',compact('subAccounts','level3'));
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
            'title'=>'required || unique:level_threes,title,NULL,id,deleted_at,NULL',
            'sub_account_id'=>'required',
            'opening_date'=>'required',
           
        ]);

        if($validations->fails())
        {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }


        $level_three = new LevelThree;
        $level_three->title = $request->title;
        $level_three->sub_account_id = $request->sub_account_id;
        $level_three->date = Carbon::createFromFormat('d / m / y', $request->opening_date)->format('y-m-d');
        // $level_three->transaction_type = $request->transaction_type;
        // $level_three->opening_balance = str_replace(',','',$request->opening_balance);
        $level_three->created_by = Auth::user()->id;
        if($level_three->save()){
            $level_three->code = str_pad($level_three->id, 6, '0', STR_PAD_LEFT);
            $level_three->save();
            return response()->json(['success' => true, 'message' =>'Level 3 Accounts has been added successfully', 'data'=>$level_three]);
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
        $accounts = SubAccount::all();
        $level_three = LevelThree::where('id',$id)->first();
        return view('admin.level_three.edit',compact('accounts','level_three'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LevelThree  $LevelThree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LevelThree $level3)
    {

        $validations = Validator::make($request->all(),[
            'title'=>'required || unique:level_threes,title,'.$level3->id,
            'sub_account_id'=>'required',
            'opening_date'=>'required',
          

        ]);
        if($validations->fails())
        {
            return response()->json(['success' => false, 'message' => $validations->errors()]);
        }

        $level3->title = $request->title;
        $level3->sub_account_id = $request->sub_account_id;
        $level3->date = Carbon::createFromFormat('d / m / y', $request->opening_date)->format('y-m-d');
        // $level3->transaction_type = $request->transaction_type;
        // $level3->opening_balance = str_replace(',','',$request->opening_balance);
        $level3->created_by = Auth::user()->id;
        if($level3->save()){
           
            return response()->json(['success' => true, 'message' =>'level 3 Accounts has been updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubAccount  $subaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($subAccount)
    {
        // if(!SubAccount::where('id', $subAccount)->whereHas('get_debit_subaccount')->exists() && !SubAccount::where('id', $subAccount)->whereHas('get_credit_subaccount')->exists()){
        //     if(SubAccount::where('id', $subAccount)->delete()){
        //         return response()->json(['success' => true, 'message' =>'Sub Account has been deleted successfully']);
        //     }
        // }else{
        //     return response()->json(['success' => false , 'redirect'=>false , 'message' =>'Please delete vouchers first ']);
        // }

        if(LevelThree::where('id',$subAccount)->delete()){
            return response()->json(['success' => true, 'message' =>'Sub Accounts has been deleted successfully']);
        }
    }
}
