<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Http\Requests\CreateLoan;
use App\Http\Requests\UpdateLoan;
use App\Models\NewMemberModel;
use Illuminate\Support\Facades\DB;


class LoanController extends Controller
{
    public function index()
    {
        $loan = DB::table('loan')
            ->select('member.*', 'loan.*')
            ->join('member', 'member.id', 'loan.member_id')
            ->where('loan.status', 0)
            ->orderBy('loan.id', 'DESC')
            ->get();
        return view('admin.loan.loan')->with('loan', $loan);
    }

    public function create()
    {
        $member = new NewMemberModel;
        $member = NewMemberModel::all();
        return view('admin.loan.newloan')->with('member', $member);
    }

    public function store(CreateLoan $request)
    {
        $loan = new Loan;
        $loan_date = $request->input('loan_date');
        $loan_date = date("Y-m-d", strtotime($loan_date));
        $member_id = $request->input('loan_holder');
        $uniqid = 'loan/' . $member_id . '/' . $loan_date . '/' . rand(1000, 9999);
        $loan->loan_type = $request->input('loan_type');
        $loan->loan_date = $loan_date;
        $loan->loan_no = $uniqid;
        $loan->loan_reason = $request->input('loan_reason');
        $loan->member_id = $request->input('loan_holder');
        $loan->loan_amt = $request->input('loan_amt');
        $loan->loan_profit = $request->input('loan_profit');
        $loan->paidup_amount = 0;
        $loan->paidup_date = date("Y-m-d", strtotime($loan_date));
        $loan->loan_installment = $request->input('loan_installment');
        $loan->loan_duration = $request->input('loan_duration');
        $loan->loan_g_1 = $request->input('loan_g_1');
        $loan->loan_g_2 = $request->input('loan_g_2');
        $loan->status = 1;
        $loan->save();

        return redirect('/role-loan')->with('status', 'Loan Added Successfully');
    }

    public function edit($id)
    {
        $loan = DB::table('loan')
            ->select('member.*', 'loan.*')
            ->join('member', 'member.id', 'loan.member_id')
            ->where('loan.id', array($id))
            ->get()->first();
        //   print_r($loan); die();
        $member1 = new NewMemberModel;
        $member1 = NewMemberModel::find($id);

        $member = Loan::findorFail($id);
        return view('admin.loan.edit')->with(['member' => $member, 'member1' => $member1, 'loan' => $loan]);
    }

    public function update(UpdateLoan $request, $id)
    {
        $loan = Loan::find($id);
        $loan->loan_type = $request->input('loan_type');
        $loan->loan_date = $request->input('loan_date');
        $loan->loan_reason = $request->input('loan_reason');
        $loan->loan_amt = $request->input('loan_amt');
        $loan->loan_profit = $request->input('loan_profit');
        $loan->loan_installment = $request->input('loan_installment');
        $loan->loan_duration = $request->input('loan_duration');
        $loan->loan_g_1 = $request->input('loan_gar_1');
        $loan->loan_g_2 = $request->input('loan_gar_1');
        $loan->update();

        return redirect('/role-loan')->with('status', 'Loan Edit Successfully');
    }

    public function delete($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return response()->json(['status' => 'Loan Deleted Successfully!']);
    }
    public function paidup_loan()
    {
        $paid_loan = Loan::select(DB::raw("COUNT(*) as count_row, 
        SUM(loan.loan_amt) as TotalLoan,
        SUM(loan.loan_installment) as Totalinst, member.name, loan.member_id"))
            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->groupBy(DB::raw("loan.member_id,member.name"))
            ->where('loan.status', 0)
            ->orderBy('count_row', 'DESC')
            ->get();

        return view('admin.loan.paidLoanList')->with('paid_loan', $paid_loan);
    }
}
