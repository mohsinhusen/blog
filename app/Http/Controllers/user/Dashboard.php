<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\LoanInstallment;
use App\Models\Member_Invest;

use Illuminate\Support\Facades\DB;


class Dashboard extends Controller
{
  public function __construct()
  {
    //    $this->middleware('auth:member');
  }

  public function index()
  {
    $id = Auth::guard('member')->user()->id;
    $total_loan = DB::table("loan")
      //   ->select(DB::raw("COUNT(*) as count_loan"))
      ->Join('member', 'loan.member_id', '=', 'member.id')
      ->where('loan.status', 1)
      ->where('member.id', $id)
      ->get()->count();

    $total_invest = DB::table("member_investment")
      ->select(DB::raw("SUM(member_investment.amount) as invest_amount,SUM(member_investment.p_share) as purchase_share"))
      ->Join('member', 'member_investment.member_id', '=', 'member.id')
      ->groupBy(DB::raw("member_investment.amount"))
      ->where('member.role', 'member')
      ->where('member.id', $id)
      ->get()->first();


    $total_share_amt = Member_Invest::all()->sum('amount');
    $loan_cur_prft = LoanInstallment::all()->sum('amount_profit');
    $total_pshare = Member_Invest::all()->sum('p_share');


    return view('user.userDashboard')->with([
      'total_loan' => $total_loan,
      'total_invest' => $total_invest,
      'total_share_amt' => $total_share_amt,
      'loan_cur_prft' => $loan_cur_prft,
      'total_pshare' => $total_pshare
    ]);
  }

  public function total_loans()
  {
    $id = Auth::guard('member')->user()->id;
    $loan_detail = DB::table("loan")
      ->select(DB::raw("loan.id,loan.loan_amt,loan.loan_date,member.name,loan.member_id,loan.loan_installment,
      SUM(loan.loan_installment) as total_inst"))
      ->Join('member', 'loan.member_id', '=', 'member.id')
      ->where('loan.status', 1)
      ->where('member.id', $id)
      ->groupBy(DB::raw("loan.id,loan.loan_amt,loan.loan_date,member.name,loan.member_id,loan.loan_installment"))
      ->get();

    return view('user/Loan/totalLoan')->with([
      'loan_detail' => $loan_detail,
    ]);
  }

  public function summary_loans($id)
  {
    $installment_details = DB::table('loan')
      ->join('member', 'loan.member_id', 'member.id')
      ->join('loan_installment', 'member.id', 'loan_installment.member_id')
      ->select('loan_installment.*', 'loan.*', 'member.*')
      ->where('loan.status', 1)
      ->where('loan.id', array($id))
      ->get()->first();
    //      echo "<pre>"; print_r($installment_details); die(); 
    if ($installment_details != null) {

      $installment_statement = DB::table('loan_installment')
        ->join('loan', 'loan_installment.loan_id', 'loan.id')
        ->join('member', 'loan.member_id', 'member.id')
        ->select('loan_installment.*', 'loan.*', 'member.*', 'loan_installment.id')
        ->where('loan_installment.loan_id', $id)
        ->get();

      //      echo "<pre>"; print_r($installment_statement); die(); 

      $current_profit = DB::table("loan_installment")
        ->select(
          DB::raw("
                                        SUM(loan_installment.amount_profit) as current_profit,
                                        SUM(loan_installment.taxable_amount+loan_installment.amount_profit) as totalpaid_amount,
                                        SUM(loan_installment.taxable_amount) as paid_amount,
                                        COUNT(loan_installment.loan_id) as total_paid_installment,
                                        loan.loan_no,loan.member_id, member.name, loan.loan_date ")
        )
        ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
        ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
        ->groupBy(DB::raw("loan_installment.loan_id, member.name, loan.member_id, loan.loan_no, loan.loan_date"))
        ->where('loan_installment.loan_id', $id)
        ->get()->first();

      //         echo "<pre>"; print_r($current_profit); die(); 

      return view('user.Loan.viewLoans')->with([
        'installment_details' => $installment_details,
        'installment_statement' => $installment_statement,
        'current_profit' => $current_profit,
        '$id' => $id
      ]);
    } else {
      echo  $msg = "No Paid any installment";
    }
  }

  public function summary_investment()
  {
    $id = Auth::guard('member')->user()->id;
    $invest = DB::table('member')
      ->select('member_investment.*', 'member.*')
      ->join('member_investment', 'member_investment.member_id', 'member.id')
      ->where('role', 'member')
      ->where('member_id', $id)
      ->get()->first();

    if ($invest != null) {

      $member_detail = DB::select('select * from member_investment where member_id = ?', array($id));
      $purchase_share = DB::table('member_investment')
        ->select('p_share')
        ->where('member_id', '=', array($id))->sum('p_share');
      $total_amt = DB::table('member_investment')
        ->whereRaw('member_id = ?', $id)->sum('amount');

      $total_share_amt = Member_Invest::all()->sum('amount');
      $loan_cur_prft = LoanInstallment::all()->sum('amount_profit');
      $total_pshare = Member_Invest::all()->sum('p_share');

      return view('user.investment.summeryInvest')
        ->with([
          'member_detail' => $member_detail,
          'invest' => $invest,
          'total_amt' => $total_amt,
          'total_pshare' => $total_pshare,
          'total_share_amt' => $total_share_amt,
          'loan_cur_prft' => $loan_cur_prft,
          'purchase_share' => $purchase_share
        ]);
    } else {
      echo "Not Invest";
    }
  }
}
