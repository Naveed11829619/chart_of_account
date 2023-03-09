<?php

use App\Http\Controllers\ChartOfAccountReportDetailController;
use App\Http\Controllers\FetchAllController;
use App\Http\Controllers\FinalAccountController;
use App\Http\Controllers\FinalReportController;
use App\Http\Controllers\JournalVoucherController;
use App\Http\Controllers\LevelThreeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    Artisan::call('view:clear');
    $homeURL = url('/');
    return 'Views Cleared, Routes Cleared, Cache Cleared, and Config Cleared Successfully ! <a href="' . $homeURL . '">Go Back To Home</a>';
});


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::post('uploadFile', 'ProductController@uploadAllFiles')->name('uploadFile');

Route::middleware(['auth'])->group(function () {
    Route::view('/home', 'admin.index')->name('dashboard');
    Route::view('/dashboard', 'admin.index');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('accounts', AccountsController::class);
    Route::resource('sub-accounts', SubAccountController::class);
    Route::resource('level3', LevelThreeController::class);
    Route::resource('final_account', FinalAccountController::class);
    Route::resource('products', ProductController::class);
    Route::resource('salePurchase', SalePurchaseVoucherController::class);
    Route::post('applyFilter', 'SalePurchaseVoucherController@applyFilter')->name('applyFilter');
    Route::resource('journal', JournalVoucherController::class);
    Route::post('journalDate', [JournalVoucherController::class, 'search']);


    Route::get('coa', [ChartOfAccountReportDetailController::class, 'index']);
    Route::get('coa/report',[ChartOfAccountReportDetailController::class,'pdf_Report']);


    // Route::get('coa/pdf',[ChartOfAccountReportDetailController::class,'pdf_Report']);
    Route::get('partyAccount', 'PartyAccountLedgerController@index')->name('partyAccount');
    Route::post('getPartyAccountData', 'PartyAccountLedgerController@entriesBetweenDates')->name('getPartyAccountData');
    Route::post('getFinalAccountData', [FinalReportController::class, 'entriesBetweenDates'])->name('getFinalAccountData');
    Route::get('agingReport', 'AgingReportController@index')->name('aging_report');
    Route::post('getAgentReportData', 'AgingReportController@entriesBetweenDates')->name('getAgentReportData');
    Route::get('trialBalance', 'TrialBalanceController@index')->name('trialBalance');
    Route::post('getTrialBalance', 'TrialBalanceController@getTrialBalance')->name('getTrialBalance');
    Route::post('checkPassword', 'TrialBalanceController@checkPassword')->name('checkPassword');

    Route::post('changePassword', 'TrialBalanceController@changePassword')->name('changePassword');

    // Reports Routes Start
    Route::get('partyAccountReport/{sub_account_id}/{start_date}/{end_date}', 'ReportsController@partyAccountReport')->name('partyAccountReport');
    Route::get('finalAccountAccountReport/{start_date}/{end_date}', 'ReportsController@finalAccountAccountReport')->name('finalAccountAccountReport');

    Route::post('salePurchaseReport', 'ReportsController@salePurchaseReport')->name('salePurchaseReport');
    Route::get('journalReport', 'ReportsController@journalReport')->name('journalReport');
    Route::get('trialReport/{start_date}/{end_date}', 'ReportsController@trialReport')->name('trialReport');
    Route::get('final_report', [FinalReportController::class, 'index']);
    

    //Print 

    Route::get('printvoucher/{id}',[JournalVoucherController::class,'show'])->name('printvoucher');
    Route::post('journal_print_view',[JournalVoucherController::class,'printView'])->name('journal_print_view');

    //backup database
    Route::get('/our_backup_database', 'HomeController@our_backup_database')->name('our_backup_database');
});
