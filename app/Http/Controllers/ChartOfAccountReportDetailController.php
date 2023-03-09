<?php

namespace App\Http\Controllers;

use App\Account;
use App\SubAccount;
use PDF;
use Illuminate\Http\Request;

class ChartOfAccountReportDetailController extends Controller
{
    public function index(){
       $levelones =  Account::with('get_sub_accounts')->get();
       return view('admin.coa_report.view_coa_details',compact('levelones'));
    }







    public function pdf_Report(){
      ini_set ( 'max_execution_time', -1); //unlimit
      $levelones =  Account::with('get_sub_accounts')->get();
      $pdf = PDF::loadView('admin.coa_report.pdf_coa_details', compact('levelones'));
      // download PDF file with download method
        return $pdf->download('Chart of Account'.'.pdf');
      // return view('admin.coa_report.pdf_coa_details',compact('levelones'));
    }
}
