<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LoanInstallment;
use App\Models\Member_Invest;
use App\Models\Expense;
use App\Models\Loan;
use App\Models\MedicalHelp;
use App\Models\OnHand;

class LedgerController extends Controller
{

    public function index()
    {
        return view('admin.ledger.rojmeldate');
    }
    public function viewreport(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)
            ->toDateString();

        $end_date = Carbon::parse($request->end_date)
            ->toDateString();

        $member_investment = Member_Invest::selectRaw('SUM(amount) as inv_amt')
            ->whereBetween('date', [$start_date, $end_date])
            ->get()->sum('inv_amt');

        $f = Carbon::parse($start_date)->subMonth()->startOfMonth()->toDateString();
        $l = Carbon::parse($start_date)->subMonth()->endOfMonth()->toDateString();

        $loan_installment = LoanInstallment::selectRaw('SUM(inst_amount) as inst_amt')
            ->whereBetween('inst_date', [$f, $l])
            ->get()->sum('inst_amt');

        $expense = Expense::selectRaw('SUM(exp_amount) as exp_amt')
            ->whereBetween('exp_date', [$start_date, $end_date])
            ->get()->sum('exp_amt');

        $loan = Loan::selectRaw('SUM(loan_amt) as loan_amt')
            ->whereBetween('loan_date', [$start_date, $end_date])
            ->get()->sum('loan_amt');

        $help = MedicalHelp::selectRaw('SUM(help_amount) as help_amt')
            ->whereBetween('help_date', [$start_date, $end_date])
            ->get()->sum('help_amt');

        $loan_paidup = Loan::selectRaw('SUM(paidup_amount) as loan_paidup')
            ->whereBetween('paidup_date', [$start_date, $end_date])
            ->get()->sum('loan_paidup');

        $help_return = MedicalHelp::selectRaw('SUM(help_amount) as help_r_amt')
            ->whereBetween('help_date', [$start_date, $end_date])
            ->where('status', 0)
            ->get()->sum('help_r_amt');

        $f = Carbon::parse($start_date)->subMonth()->startOfMonth()->toDateString();
        $l = Carbon::parse($start_date)->subMonth()->endOfMonth()->toDateString();

        $onhand_amount = OnHand::selectRaw('SUM(onhand_amount) as hand_amt')
            ->whereBetween('date', [$f, $l])
            ->get()->sum('hand_amt');

        return view('admin.ledger.report')->with([
            'member_investment' => $member_investment,
            'loan_installment' => $loan_installment,
            'expense' => $expense,
            'loan' => $loan,
            'help_return' => $help_return,
            'help' => $help,
            'loan_paidup' => $loan_paidup,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'onhand_amount' => $onhand_amount
        ]);
    }
}
