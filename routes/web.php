<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\user;
use App\Http\Controllers\pdf;
use App\Http\Controllers\subAdmin;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
  return view('welcome');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/login/member', [App\Http\Controllers\Auth\LoginController::class, 'ShowMemberLogin']);
Route::post('/login/member', [App\Http\Controllers\Auth\LoginController::class, 'MemberLogin']);
Route::get('/logout/member', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('/total-loans', [user\Dashboard::class, 'total_loans']);
Route::get('/summary-loans/{id}', [user\Dashboard::class, 'summary_loans']);
Route::get('/summary-investment/{id}', [user\Dashboard::class, 'summary_investment']);
Route::get('/member-dashboard', [user\Dashboard::class, 'index']);
Route::get('/new-user-loan', [user\LoanApplication::class, 'create_loan']);
Route::post('/request-loan', [user\LoanApplication::class, 'store']);

// Sub Admin Group Routes
Route::group(['middleware' => ['auth', 'subadmin']], function () {
  Route::get('/sub-admindashboard', [subAdmin\Dashboard::class, 'index']);
  Route::get('/new-installment', [subAdmin\Dashboard::class, 'new_installment']);
  Route::post('/getmember_id', [subAdmin\Dashboard::class, 'getmember_detail']);
  Route::get('/collection-repay', [subAdmin\Dashboard::class, 'collect_repay']);
  Route::get('/collection-due', [subAdmin\Dashboard::class, 'collect_due']);
  Route::get('/active-loan', [subAdmin\Dashboard::class, 'active_loan']);
  Route::get('/loan-installment/{id}', [subAdmin\Dashboard::class, 'view_installment']);
  Route::put('/add-installment/{id}', [subAdmin\Dashboard::class, 'add_installment']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
  // Admin dashboard Route
  Route::get('/dashboard', [Admin\DashboardController::class, 'index']);
  Route::get('/role-register', [Admin\DashboardController::class, 'registerd']);
  Route::get('/role-edit/{id}', [Admin\DashboardController::class, 'registeredit']);
  Route::put('/role-register-update/{id}', [Admin\DashboardController::class, 'registerupdate']);
  Route::delete('/role-delete/{id}', [Admin\DashboardController::class, 'registerdelete']);

  // New Member dashboard Route
  Route::get('/new-member', [Admin\NewMemberController::class, 'index']);
  Route::get('/create-member', [Admin\NewMemberController::class, 'create']);
  Route::post('/member-store', [Admin\NewMemberController::class, 'store']);
  Route::get('/member-edit/{id}', [Admin\NewMemberController::class, 'edit']);
  Route::put('/member-cat-edit/{id}', [Admin\NewMemberController::class, 'update']);
  Route::delete('/member-delete/{id}', [Admin\NewMemberController::class, 'delete']);

  // Member_Investment Route
  Route::get('/role-investment/{id}', [Admin\MemberInvestment::class, 'index']);
  Route::get('/view-investment/{id}', [Admin\MemberInvestment::class, 'view_investment']);
  Route::post('/add-investment', [Admin\MemberInvestment::class, 'store']);
  Route::get('/edit-invest/{id}', [Admin\MemberInvestment::class, 'edit_view']);
  Route::put('/edit-investment/{id}', [Admin\MemberInvestment::class, 'update']);
  Route::delete('/delete-invest/{id}', [Admin\MemberInvestment::class, 'delete']);

  //Member get list non-member and member report
  Route::get('/member', [Admin\MemberInvestment::class, 'member']);
  Route::get('/non-member', [Admin\MemberInvestment::class, 'non_member']);


  // Admin dashboard Route
  Route::get('/role-loan', [Admin\LoanController::class, 'index']);
  Route::get('/new-loan', [Admin\LoanController::class, 'create']);
  Route::post('/store-loan', [Admin\LoanController::class, 'store']);
  Route::get('/edit-loan/{id}', [Admin\LoanController::class, 'edit']);
  Route::put('/role-edit-loan/{id}', [Admin\LoanController::class, 'update']);
  Route::delete('/delete-loan/{id}', [Admin\LoanController::class, 'delete']);

  Route::get('/paidup-loan', [Admin\LoanController::class, 'paidup_loan']);
  Route::get('/loanpersonaldetail/{id}', [Admin\DashboardController::class, 'loanpersonal_detail']);
  Route::get('/paid-loan-details/{id}', [Admin\DashboardController::class, 'paid_loandetails']);
  Route::get('/current-profit', [Admin\DashboardController::class, 'current_profit']);
  Route::get('/received-profit', [Admin\DashboardController::class, 'received_profit']);
  //Route::get('/profit-wise', [Admin\DashboardController::class, 'profit_wise']);
  Route::get('/getProfit-detail', [Admin\DashboardController::class, 'getProfit_detail']);

  Route::post('/paid-loan', [Admin\LoanController::class, 'paid_loan']);

  Route::get('/profit-wise', function () {
    return view('admin.loan.profitWise');
  });

  Route::get('/loan-calc', function () {
    return view('admin.loan.loanCalc');
  });

  Route::get('/loan-paidup', function () {
    return view('admin.loan.paidLoan');
  });

  Route::get('/loan-paid', function () {
    return view('admin.loan.loan_paidup');
  });

  //Loan Installment Route
  Route::get('/role-installment', [Admin\InstallmentController::class, 'index']);
  Route::post('/getmember_detail', [Admin\InstallmentController::class, 'getmember_detail']);
  Route::post('/installment-store', [Admin\InstallmentController::class, 'store']);
  Route::get('/view-installment/{id}', [Admin\InstallmentController::class, 'view_installment']);
  Route::get('/installment-edit-view/{id}', [Admin\InstallmentController::class, 'installment_edit_view']);
  Route::put('/installment-edit/{id}', [Admin\InstallmentController::class, 'installment_edit']);
  Route::delete('/installment-delete/{id}', [Admin\InstallmentController::class, 'installment_delete']);
  Route::put('/installment-store-model/{id}', [Admin\InstallmentController::class, 'store_bymodal']);

  Route::get('/search', [Admin\InstallmentController::class, 'search']);
  Route::post('/fetch_data', [Admin\InstallmentController::class, 'fetch_data']);
  


  // For Ledger Route Files
  Route::get('/view-dailybook', [Admin\LedgerController::class, 'index'])->name('view-dailybook');
  Route::post('/report', [Admin\LedgerController::class, 'viewreport']);

  // For Expense Route Files
  Route::get('/view-expense', [Admin\ExpenseController::class, 'view_expense']);
  Route::get('/new-expense', [Admin\ExpenseController::class, 'create']);
  Route::post('/role-addExpense', [Admin\ExpenseController::class, 'store']);
  Route::get('/edit-expense/{id}', [Admin\ExpenseController::class, 'edit']);
  Route::put('/role-edit-expense/{id}', [Admin\ExpenseController::class, 'update']);
  Route::delete('/delete-expense/{id}', [Admin\ExpenseController::class, 'delete']);

  // For Get No's Of Time loan count display
  Route::get('/total-loan', [Admin\DashboardController::class, 'total_loan']);
  Route::get('/total-repay', [Admin\DashboardController::class, 'total_repay']);
  Route::get('/Total-Clearance-Profit', [Admin\DashboardController::class, 'TotalClearanceProfit']);
  Route::put('/paidup-loan/{id}', [Admin\DashboardController::class, 'paidup_loan']);
  Route::get('/Total-Clearance-Amount', [Admin\DashboardController::class, 'TotalClearanceAmount']);
  Route::get('/Total-Invest-Amount', [Admin\DashboardController::class, 'TotalInvestAmount']);
  Route::get('/collect-repay', [Admin\DashboardController::class, 'collect_repay']);
  Route::get('/due-installment', [Admin\DashboardController::class, 'due_installment']);
  Route::get('/onhand-report', [Admin\DashboardController::class, 'onhand']);
  Route::get('/loan-applied', [Admin\DashboardController::class, 'loan_applied']);

  // Assign Role routing
  Route::get('/assign-role', [Admin\AssignRole::class, 'create']);
  Route::get('/view-role', [Admin\AssignRole::class, 'view_role']);
  Route::post('/role-add', [Admin\AssignRole::class, 'store']);
  Route::get('/Edit-role/{id}', [Admin\AssignRole::class, 'edit_role']);
  Route::put('/Update-Role/{id}', [Admin\AssignRole::class, 'update']);
  Route::delete('/Delete-Role/{id}', [Admin\AssignRole::class, 'delete']);

  //Help Form Redirect Pages
  Route::get('/role-help_create', [Admin\Help::class, 'create']);
  Route::post('/role-Add-Help', [Admin\Help::class, 'store']);
  Route::get('/role-view-help', [Admin\Help::class, 'view_help']);
  Route::get('/role-edit-help/{id}', [Admin\Help::class, 'edit_view_help']);
  Route::put('/edit-help/{id}', [Admin\Help::class, 'edit_help']);
  Route::delete('/delete-help/{id}', [Admin\Help::class, 'delete']);
  Route::get('/report-help', [Admin\Help::class, 'report_help']);
  Route::get('/report-totalhelp', [Admin\Help::class, 'report_totalhelp']);

  //make pdf
  Route::get('/export-pdf/{id}', [pdf\GeneratePdfController::class, 'exportPdf']);
  //  Route::get('/pdf_download', 'GeneratePdfController@pdfDownload');
});
