<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\NewMemberModel;
use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\Expense;
use App\Models\MedicalHelp;
use App\Models\Member_Invest;
use App\Models\OnHand;
use App\Models\Loan_Application;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Response;

use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function currentCashOnhand()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $previousMonthTotalloanAmount = Loan::whereBetween('loan_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('loan_amt');

        $previousMonthTotalExpenseAmount = Expense::whereBetween('exp_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('exp_amount');

        $previousMonthTotalHelpAmount = MedicalHelp::whereBetween('help_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('help_amount');

        $total_outward_amount = ($previousMonthTotalloanAmount + $previousMonthTotalExpenseAmount + $previousMonthTotalHelpAmount);

        //Fetch the data from last month installment sum total based on date
        $firstDayofPreviousMonth = Carbon::now()->subMonth(1)->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonth(1)->endOfMonth()->toDateString();

        //Sum of total installment between last month
        $previousMonthTotalInstallmentAmount = LoanInstallment::whereBetween('inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('inst_amount');

        $previousMonthTotalPaidupAmount = Loan::whereBetween('loan_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('paidup_amount');

        $previousMonthTotalremainingAmount = OnHand::whereBetween('date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('onhand_amount');

        $total_outward_amount = ($previousMonthTotalloanAmount + $previousMonthTotalExpenseAmount + $previousMonthTotalHelpAmount);
        $total_inward_amount = ($previousMonthTotalInstallmentAmount + $previousMonthTotalPaidupAmount + $previousMonthTotalremainingAmount);
        $onhandAmount = abs($total_outward_amount - $total_inward_amount);

        $previousMonthOnhandAmount = onHand::whereBetween('date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->sum('onhand_amount');

        $current_date = Carbon::now()->startOfMonth()->toDateString();
        $selectDate = date('Y-m', strtotime($current_date));
        $selectYear = date('Y', strtotime($current_date));
        $selectMonth = date('m', strtotime($current_date));

        $timestamp = date("Y-m-d");

        $duplicate = onHand::select("select * from onhand where date='$selectDate' OR date='$current_date'");
        if (collect($duplicate)->first()) {
            onHand::whereYear('date', $selectYear)
                ->whereMonth('date', $selectMonth)
                ->update([
                    'outward_amount' => $total_outward_amount,
                    'inward_amount' => $total_inward_amount,
                    'remaining_amount' => $previousMonthOnhandAmount,
                    'onhand_amount' => $onhandAmount,
                    'status' => '1',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);
        } else {
            onHand::insert([
                'date' => $current_date,
                'outward_amount' => $total_outward_amount,
                'inward_amount' => $total_inward_amount,
                'remaining_amount' => $previousMonthOnhandAmount,
                'onhand_amount' => $onhandAmount,
                'status' => '1',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }



        //       $previousMonthTotalloanAmount = DB::select('SELECT SUM(loan_amt) as total_loan FROM loan WHERE loan_date BETWEEN 2020-09-01 AND 2020-09-30');

        // $expense_amount_monthly = DB::select('SELECT  SUM(exp_amount) as total_expense FROM expense WHERE MONTH(exp_date) = ' . $value1->Month . ' AND YEAR(exp_date) = ' . $year . ' LIMIT 1');
        // $installment_amount_monthly = DB::select('SELECT  SUM(inst_amount + inst_penalty) as total_inst_amount FROM loan_installment WHERE MONTH(inst_date) = ' . $value1->Month . ' AND YEAR(inst_date) = ' . $year . ' LIMIT 1');
        // $investment_amount_monthly = DB::select('SELECT  SUM(amount) as total_investment_amount FROM member_investment WHERE MONTH(date) = ' . $value1->Month . ' AND YEAR(date) = ' . $year . ' LIMIT 1');
        // $result = [];
        // $distinct_year = DB::select('SELECT DISTINCT YEAR(loan_date) as Year FROM loan');
        // foreach ($distinct_year as $key => $value) {
        //     $year = $value->Year;
        //     $result[$key]['year'] = $year;
        //     $distinct_month = DB::select('SELECT DISTINCT MONTH(loan_date) as Month FROM loan WHERE YEAR(loan_date) = ' . $year);
        //     foreach ($distinct_month as $key1 => $value1) {
        //         //$result[$key]['month'][$key1] = $value1->Month;
        //         $loan_amount_monthly = DB::select('SELECT  SUM(loan_amt) as total_loan FROM loan WHERE MONTH(loan_date) = ' . $value1->Month . ' AND YEAR(loan_date) = ' . $year . ' LIMIT 1');
        //         $expense_amount_monthly = DB::select('SELECT  SUM(exp_amount) as total_expense FROM expense WHERE MONTH(exp_date) = ' . $value1->Month . ' AND YEAR(exp_date) = ' . $year . ' LIMIT 1');
        //         $installment_amount_monthly = DB::select('SELECT  SUM(inst_amount + inst_penalty) as total_inst_amount FROM loan_installment WHERE MONTH(inst_date) = ' . $value1->Month . ' AND YEAR(inst_date) = ' . $year . ' LIMIT 1');
        //         $investment_amount_monthly = DB::select('SELECT  SUM(amount) as total_investment_amount FROM member_investment WHERE MONTH(date) = ' . $value1->Month . ' AND YEAR(date) = ' . $year . ' LIMIT 1');

        //         $result[$key]['month_total'][$key1]['month'] = $value1->Month;
        //         $result[$key]['month_total'][$key1]['total_loan'] = $loan_amount_monthly[0]->total_loan;
        //         $result[$key]['month_total'][$key1]['total_expense'] = $expense_amount_monthly[0]->total_expense;
        //         $result[$key]['month_total'][$key1]['total_installment'] = $installment_amount_monthly[0]->total_inst_amount;
        //         $result[$key]['month_total'][$key1]['total_investment'] = $investment_amount_monthly[0]->total_investment_amount;
        //         $result[$key]['month_total'][$key1]['total_in_cash'] = (($loan_amount_monthly[0]->total_loan + $expense_amount_monthly[0]->total_expense + $investment_amount_monthly[0]->total_investment_amount) - ($installment_amount_monthly[0]->total_inst_amount));
        //     }
        // }
        // //  echo '<pre>';print_r($result_final[0]['total_in_cash']); die();


        // $result_final = [];
        // if (!empty($result)) {
        //     $result = array_filter($result, function ($values) {
        //         $current_year = date('Y');
        //         if ($values['year'] == $current_year) {
        //             return $values;
        //         }
        //     });
        //     $current_month = date("m", strtotime("-1 months", strtotime(date("Y-m") . "-01")));
        //     foreach ($result as $key => $value) {
        //         foreach ($value['month_total'] as $key1 => $value1) {
        //             if ($value1['month'] == $current_month) {
        //                 $result_final[] =   $value1;
        //             }
        //         }
        //     }
        // }
        // // echo '<pre>';
        // // print_r($result);
        // // die();

        return $onhandAmount;
        // //  echo '<pre>';print_r($result_final[0]['total_in_cash']); die();

        // //echo $newdate = date("m", strtotime("-1 months", strtotime(date("Y-m")."-01"))); die();
    }

    public function index()
    {
        $total_in_cash =  $this->currentCashOnhand();
        $member = NewMemberModel::where('role', 'member')->count();
        $nonmember = NewMemberModel::where('role', 'other')->count();
        $loan = Loan::where('status', '1')->count();
        $amt = Loan::where('status', '1')->sum('loan_amt');
        $help = MedicalHelp::where('status', '1')->sum('help_amount');
        $total_help = MedicalHelp::sum('help_amount');
        $loan_installment = Loan::whereRaw('status', '1')->sum('loan_installment');
        $loan_profit_total = Loan::whereRaw('status', '1')->sum('loan_profit');
        $total_pshare = Member_Invest::sum('p_share');
        $total_share_amt = Member_Invest::sum('amount');
        $loan_cur_prft = LoanInstallment::sum('amount_profit');
        $last_expense = Expense::all()->last()->pluck('exp_amount')->last();

        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $total_repay = LoanInstallment::whereBetween('inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->count();

        $unpaid = ($loan - $total_repay);
        $loan_installment = Loan::whereRaw('status', '1')->sum('loan_installment');
        $collect_pay = NewMemberModel::select(LoanInstallment::raw("SUM(loan_installment.inst_amount) as sumofinstallment,member.id"))
            ->join('loan_installment', 'member.id', 'loan_installment.member_id')
            ->groupBy(NewMemberModel::raw("member.id"))
            ->whereBetween('loan_installment.inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get()->sum('sumofinstallment');
        $due_pay = ($loan_installment - $collect_pay);

        $total_loan_request = Loan_Application::whereBetween('date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->count();

        return view('admin.dashboard')->with([
            'member' => $member,
            'loan' => $loan,
            'amt' => $amt,
            'loan_installment' => $loan_installment,
            'total_pshare' => $total_pshare,
            'total_share_amt' => $total_share_amt,
            'loan_cur_prft' => $loan_cur_prft,
            'loan_profit_total' => $loan_profit_total,
            'last_expense' => $last_expense,
            'total_in_cash' => $total_in_cash,
            'nonmember' => $nonmember,
            'total_repay' => $total_repay,
            'unpaid' => $unpaid,
            'collect_pay' => $collect_pay,
            'due_pay' => $due_pay,
            'help' => $help,
            'total_help' => $total_help,
            'total_loan_request' => $total_loan_request
        ]);
    }

    public function registerd()
    {
        $users = User::count();
        return view('admin.register')->with('users', $users);
    }

    public function registeredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.register-edit')->with('users', $users);
    }

    public function registerupdate(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->update();
        return redirect('/role-register')->with('status', 'Your Data is Updated!');
    }

    public function registerdelete($id)
    {
        $users = User::findorFail($id);
        $users->delete();
        return redirect('/role-register')->with('status', 'Your Data is Deleted!');
    }

    public function total_loan()
    {
        $loan_no = Loan::select(DB::raw("COUNT(*) as count_row, 
        SUM(loan.loan_amt) as TotalLoan,
        SUM(loan.loan_installment) as Totalinst, member.name, loan.member_id"))
            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->groupBy(DB::raw("loan.member_id,member.name"))
            ->where('loan.status', 1)
            ->orderBy('count_row', 'DESC')
            ->get();

        return view('admin.loan.totalLoan')->with('loan_no', $loan_no);
    }

    public function total_repay()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $total_repay = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as cur_profit,
        SUM(loan_installment.taxable_amount) as loan_amount,
                                          COUNT(loan_installment.loan_id) as total_installment,
                                          loan.loan_no,loan.id, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan.paidup_amount,loan_installment.inst_amount"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.loan_date,loan.paidup_amount,loan.id,loan_installment.loan_id, member.name, loan.member_id, loan.loan_no,loan_installment.inst_amount"))
            ->where('loan.status', 1)
            ->get();


        $loan_installment = Loan::whereRaw('status', '1')->sum('loan_installment');


        return view('admin.loan.totalRepay')->with([
            'total_repay' => $total_repay,
            'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
            'lastDayofPreviousMonth' => $lastDayofPreviousMonth,
            'loan_installment' => $loan_installment
        ]);
    }

    public function loanpersonal_detail($id)
    {
        $loan_personaldetail = Loan::select(DB::raw("loan.id,loan.loan_amt,loan.loan_date,member.name,loan.member_id,loan.loan_installment"))
            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->where('loan.status', 1)
            ->where('member.id', $id)
            ->get();
        return view('admin.loan.loanPersonaldetail')
            ->with('loan_personaldetail', $loan_personaldetail);
    }

    public function paid_loandetails($id)
    {
        $paid_loandetail = Loan::select(DB::raw("loan.id,loan.loan_amt,loan.loan_date,member.name,loan.member_id,loan.loan_installment"))
            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->where('loan.status', 0)
            ->where('member.id', $id)
            ->get();
        return view('admin.loan.paidLoanDetails')
            ->with('paid_loandetail', $paid_loandetail);
    }



    public function current_profit()
    {
        $current_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as cur_profit,
        SUM(loan_installment.taxable_amount) as loan_amount,
                                          COUNT(loan_installment.amount_profit) as total_installment,
                                          loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan.paidup_amount"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.loan_date,loan.paidup_amount,loan_installment.loan_id, member.name, loan.member_id, loan.loan_no"))
            ->where('loan.status', 1)
            ->get();

        $c_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as cur_profit,
            COUNT(loan_installment.amount_profit) as total_installment,
            loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan.paidup_amount"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.loan_date,loan.paidup_amount,loan_installment.loan_id, member.name, loan.member_id, loan.loan_no"))
            ->where('loan.status', 1)
            ->get()
            ->sum('cur_profit');

        $received_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as current_profit,
            COUNT(loan_installment.amount_profit) as total_installment,
            loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan_installment.status,loan.paidup_amount,loan.paidup_date"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.paidup_date,loan.loan_date,loan.paidup_amount,loan_installment.loan_id, member.name,loan_installment.status, loan.member_id, loan.loan_no"))
            ->where('loan.status', 0)
            ->get();

        $r_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as r_profit,
            COUNT(loan_installment.amount_profit) as total_installment,
            loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan.paidup_amount"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.loan_date,loan.paidup_amount,loan_installment.loan_id, member.name, loan.member_id, loan.loan_no"))
            ->where('loan.status', 0)
            ->get()
            ->sum('r_profit');

        return view('admin.loan.currentProfit')->with([
            'current_profit' => $current_profit,
            'received_profit' => $received_profit,
            'c_profit' => $c_profit,
            'r_profit' => $r_profit
        ]);
    }

    public function received_profit()
    {
        $received_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as current_profit,
            COUNT(loan_installment.amount_profit) as total_installment,
            loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan_installment.status,loan.paidup_amount,loan.paidup_date"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.paidup_date,loan_installment.loan_id,loan.loan_date,loan.paidup_amount,member.name,loan_installment.status, loan.member_id, loan.loan_no"))
            ->where('loan.status', 0)
            ->get();

        $r_profit = LoanInstallment::select(DB::raw("SUM(loan_installment.amount_profit) as r_profit,
            COUNT(loan_installment.amount_profit) as total_installment,
            loan.loan_no, loan.member_id, member.name, loan.loan_date,loan_installment.loan_id,loan.paidup_amount"))
            ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
            ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
            ->groupBy(DB::raw("loan.loan_date,loan.paidup_amount,loan_installment.loan_id, member.name, loan.member_id, loan.loan_no"))
            ->where('loan.status', 0)
            ->get()
            ->sum('r_profit');

        return view('admin.loan.receivedProfit')->with([
            'received_profit' => $received_profit,
            'r_profit' => $r_profit
        ]);
    }

    public function getProfit_detail()
    {
        $yrs = $_POST['id'];

        echo "<pre>";
        print_r($yrs);
        die();

        $member_id = Loan::whereRaw('id = ?', array($loan_id))
            ->get()->first();
        $installment = $member_id->loan_installment;
        return response()->json(['installment' => $installment]);
    }


    public function profit_wise()
    {
        $years = Loan::select(DB::raw('YEAR(loan_date) year'))
            ->distinct()
            ->get();
        return view('admin.loan.profitWise')->with([
            'years' => $years,
        ]);
    }


    public function TotalClearanceProfit()
    {
        $TotalClearanceProfit = loan::select('member.*', 'loan.*')
            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->where('loan.status', 1)
            ->get();
        return view('admin.loan.TotalClearanceProfit')->with('TotalClearanceProfit', $TotalClearanceProfit);
    }

    public function paidup_loan(Request $request, $id)
    {
        $loan_paidup = Loan::find($id);
        $loan_paidup->paidup_amount = $request->input('paidup_amount');
        $loan_paidup->paidup_date = $request->input('paidup_date');
        $loan_paidup->status = 0;
        $loan_paidup->update();
        LoanInstallment::where('loan_id', '=', $id)->update(['status' => 0]);
        return redirect('/current-profit')->with('status', 'Your Loan has been Paid Successfully');
    }

    public function collect_repay()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $year = Carbon::now()->startOfMonth()->format('Y');
        $month = Carbon::now()->startOfMonth()->format('m');

        $collect_pay = NewMemberModel::join('loan', 'member.id', 'loan.member_id')
            ->join('loan_installment', 'loan.id', 'loan_installment.loan_id')
            ->whereYear('loan_installment.inst_date', $year)
            ->whereMonth('loan_installment.inst_date', $month)
            ->whereBetween('loan_installment.inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        return view('admin.loan.collectRepay')->with([
            'collect_pay' => $collect_pay,
            'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
            'lastDayofPreviousMonth' => $lastDayofPreviousMonth
        ]);
    }


    public function due_installment()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $loan_installment = Loan::whereRaw('status', '1')->sum('loan_installment');
        $collect_pay = NewMemberModel::select(LoanInstallment::raw("SUM(loan_installment.inst_amount) as sumofinstallment,member.id"))
            ->join('loan_installment', 'member.id', 'loan_installment.member_id')
            ->groupBy(NewMemberModel::raw("member.id"))
            ->whereBetween('loan_installment.inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get()->sum('sumofinstallment');
        $due_pay = ($loan_installment - $collect_pay);

        $due = Loan::select('loan.id', 'loan.member_id', 'member.name')
            ->join('member', 'member.id', 'loan.member_id')
            ->where('loan.status', 1)
            ->get();

        $result = [];
        foreach ($due as $key => $value) {
            $member_detail = DB::select('select * from loan_installment where inst_date 
            BETWEEN ? AND ? AND(member_id = ? AND loan_id=?)  ', array($firstDayofPreviousMonth, $lastDayofPreviousMonth, $value->member_id, $value->id));
            if (empty($member_detail)) {
                $result[$key]['loan_id'] = $value->id;
                $result[$key]['memeber_id'] = $value->member_id;
                $result[$key]['member_name'] = $value->name;
            }
        }

        return view('admin.loan.totalDue')->with([
            'result' => $result,
            'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
            'lastDayofPreviousMonth' => $lastDayofPreviousMonth,
            'due_pay' => $due_pay
        ]);
    }

    public function onhand()
    {
        $onhand = onHand::whereYear('date', '2020')->orderBy('date', 'ASC')->get();
        return view('admin.onhand')->with(['onhand' => $onhand]);
    }

    public function loan_applied()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $total_loan_request = Loan_Application::whereBetween('date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->orderBy('date', 'ASC')
            ->get();
        return view('admin.loan.loanApplied')->with(['total_loan_request' => $total_loan_request]);
    }
}
