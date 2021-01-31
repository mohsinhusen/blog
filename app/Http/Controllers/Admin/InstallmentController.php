<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateInstallment;
use Carbon\Carbon;
use App\Models\LoanInstallment;
use App\Models\Loan;
use App\Models\NewMemberModel;
use Session;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    public function index()
    {
        $installment_details = NewMemberModel::leftjoin('loan', 'member.id', 'loan.member_id')
            ->where('loan.status', 1)
            ->get();

        $last_installment = LoanInstallment::join('member', 'loan_installment.member_id', 'member.id')
            ->join('loan', 'member.id', 'loan.id')
            ->where('loan.status', 1)
            ->get()->last();

        return view('admin.loan.loan_installment')
            ->with([
                'installment_details' => $installment_details,
                'last_installment' => $last_installment
            ]);
    }

    public function getmember_detail()
    {
        $loan_id = $_POST['id'];
        $member_id = Loan::whereRaw('id = ?', array($loan_id))
            ->get()->first();
        $installment = $member_id->loan_installment;
        return response()->json(['installment' => $installment]);
    }

    public function store(Request $request)
    {
        $installment = new LoanInstallment;
        $loan_id = $request->input('loan_id');
        $member_id = $request->input('member_id');
        $inst_amount = $request->input('inst_amount');
        $inst_date = $request->input('inst_date');
        $loan_no = $request->input('loan_no');
        $paid_inst = $request->input('paid_inst');
        $inst_duration = $request->input('duration');

        // $year=date("Y", strtotime($inst_date));
        // $month=date("m", strtotime($inst_date));

        $record = LoanInstallment::where('loan_id', $loan_id)
            ->where('member_id', $member_id)
            ->where('inst_amount', $inst_amount)
            ->whereMonth('inst_date', Carbon::parse($inst_date)->format('M'))
            ->whereYear('inst_date', Carbon::parse($inst_date)->format('Y'))
            ->first();


        if ($paid_inst == $inst_duration) {
            return redirect('/role-installment')->with('error', 'Sorry Your Loan Installment Over!!!');
        } else {

            $installment->loan_id = $request->input('loan_id');
            $installment->member_id = $request->input('member_id');
            $installment->inst_amount = $request->input('inst_amount');
            $installment->taxable_amount = $request->input('txt_inst_amount');
            $installment->amount_profit = $request->input('inst_profit');
            $installment->inst_date = $request->input('inst_date');
            $installment->inst_status = $request->input('inst_status');
            $installment->inst_penalty = $request->input('inst_penalty');
            $installment->status = 1;
            $installment->save();
            return redirect('/role-installment')->with('status', 'Installment Add Successfully');
        }
    }

    public function view_installment($id)
    {
        $installment_details = LoanInstallment::join('loan', 'loan_installment.loan_id', 'loan.id')
            ->join('member', 'loan.member_id', 'member.id')
            ->select('loan_installment.*', 'loan.*', 'member.*')
            ->where('loan_installment.loan_id', array($id))
            ->get()->first();

        if ($installment_details != null) {
            $installment_statement = LoanInstallment::join('loan', 'loan_installment.loan_id', 'loan.id')
                ->join('member', 'loan.member_id', 'member.id')
                ->select('loan_installment.*', 'loan.*', 'member.*', 'loan_installment.id')
                ->where('loan_installment.loan_id', array($id))
                ->orderBy('loan_installment.inst_date', 'DESC')
                ->get();

            $current_profit = LoanInstallment::select(
                DB::raw("SUM(loan_installment.amount_profit) as current_profit,
                         SUM(loan_installment.taxable_amount+loan_installment.amount_profit) as totalpaid_amount,
                         SUM(loan_installment.taxable_amount) as paid_amount,
                         COUNT(loan_installment.loan_id) as total_paid_installment,
                         loan.loan_no,loan.member_id, member.name, loan.loan_date")
            )
                ->leftJoin('member', 'loan_installment.member_id', 'member.id')
                ->leftJoin('loan', 'loan_installment.loan_id', 'loan.id')
                ->groupBy(DB::raw("loan_installment.loan_id, member.name, loan.member_id, loan.loan_no, loan.loan_date"))
                ->where('loan_installment.loan_id', array($id))
                ->get()
                ->first();

            // echo "<pre>";
            // print_r($current_profit);
            // die();

            return view('admin.loan.viewloan')
                ->with([
                    'installment_details' => $installment_details,
                    'installment_statement' => $installment_statement,
                    'current_profit' => $current_profit,
                    'id' => $id,
                ]);
        } else {
            $installment_details = NewMemberModel::leftjoin('loan', 'loan.member_id', 'member.id')
                ->where('loan.status', 1)
                ->get();

            $last_installment = LoanInstallment::join('member', 'loan_installment.member_id', 'member.id')
                ->join('loan', 'member.id', 'loan.id')
                ->where('loan.status', 1)
                ->get()
                ->last();

            return view('admin.loan.loan_installment')
                ->with([
                    'installment_details' => $installment_details,
                    'last_installment' => $last_installment
                ]);
        }
    }

    public function installment_edit_view($id)
    {
        $installment = LoanInstallment::findorFail($id);
        return view('admin.loan.installmentEdit')->with(['installment' => $installment]);
    }

    public function installment_edit(Request $request, $id)
    {
        $installment = new LoanInstallment;
        $installment = LoanInstallment::find($id);
        $installment->inst_amount = $request->input('inst_amt');
        $installment->inst_date = $request->input('inst_date');
        $installment->inst_status = $request->input('inst_status');
        $installment->inst_penalty = $request->input('inst_penalty');
        $installment->update();

        return redirect('installment-edit-view/' . $id)->with('status', 'Installment Updated Successfully');
    }

    public function installment_delete($id)
    {
        $installment = LoanInstallment::findOrFail($id);
        $installment->delete();
        return response()->json(['status' => 'Installment Deleted Successfully!']);
    }

    public function store_bymodal(Request $request, $id)
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $installment = new LoanInstallment;
        $loan_id = $request->input('loan_id');
        $member_no = $request->input('member_no');
        $inst_date = $request->input('inst_date');
        $inst_amount = $request->input('inst_amt');

        $duplicate = DB::select("select * from loan_installment where member_id='$member_no' AND loan_id='$loan_id' AND inst_date='$inst_date' AND inst_amount='$inst_amount'");
        if (collect($duplicate)->first()) {
            Session::flash('status', "Alreday Exist Installment");
            return redirect()->back();
        } else {
            $profit = Loan::whereRaw('id = ?', array($loan_id))
                ->get()->first();
            $inst = $profit->loan_profit;
            $l_id = $profit->id;
            $member_id = $profit->member_id;
            $duration = $profit->loan_duration;
            $profit_amount = $inst / $duration;
            $taxable_amt = $profit->loan_amt;
            $net_amount = ($taxable_amt / $duration);
            $installment->loan_id = $l_id;
            $installment->member_id = $member_id;
            $installment->inst_amount = $request->input('inst_amt');
            $installment->amount_profit = $profit_amount;
            $installment->taxable_amount = $net_amount;
            $installment->inst_date = $request->input('inst_date');
            $installment->inst_status = $request->input('inst_status');
            $installment->inst_penalty = $request->input('inst_penalty');
            $installment->status = 1;
            $installment->save();

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
            $loan = DB::table('loan')
                ->select('member.*', 'loan.*')
                ->join('member', 'member.id', 'loan.member_id')
                ->where('loan.status', 1)
                ->orderBy('loan.id', 'DESC')
                ->get();

            return view('admin.loan.loan')
                ->with([
                    'loan' => $loan,
                    'result' => $result,
                    'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
                    'lastDayofPreviousMonth' => $lastDayofPreviousMonth
                ])->with('status', "Installment Add Successfuly");
        }
    }

    public function search(Request $request)
    {
        $search = $request->term;

        $loans = Loan::select(DB::raw("SUM(loan_installment.amount_profit) as cur_profit,
    SUM(loan_installment.taxable_amount) as loan_amount,
    SUM(loan_installment.taxable_amount + loan_installment.amount_profit) as total_paid_amount,        
    COUNT(loan_installment.amount_profit) as total_installment,
    CONCAT(loan.id) AS full_name,
    MAX(loan_installment.inst_date) AS last_installment_paid, 
    loan.loan_no,
    loan.id,
    loan_installment.loan_id,
    member.id,         
    member.name, 
    loan.loan_amt,
    loan.loan_reason,
    loan.loan_type,
    loan.loan_date,
    loan.member_id,
    loan.loan_profit,
    loan.loan_duration,                  
    loan.member_id,         
    loan.loan_installment
    "))

            ->leftJoin('member', 'loan.member_id', '=', 'member.id')
            ->leftJoin('loan_installment', 'loan.id', '=', 'loan_installment.loan_id')
            ->where('loan.id', 'LIKE', '%' . $search . '%')
            ->groupBy(DB::raw("
        loan.id,
        loan.loan_no,
        member.name,
        loan.loan_amt,
        loan.loan_reason,
        loan.loan_type,
        loan.loan_date,
        loan.member_id,
        loan.loan_profit,
        loan.loan_duration,                  
        loan.member_id,         
        loan.loan_installment,
        loan_installment.loan_id,
        member.id,                        
        loan_installment.inst_penalty
        "))

            ->where('loan.status', 1)
            ->limit(1)
            ->get();


        foreach ($loans as $key => $value) {
            $data[] = [

                'value' => $value->full_name,
                'loan_id' => $value->loan_id,
                'name' => $value->name,
                'member_id' => $value->id,
                'installment' => $value->loan_installment,
                'loan_type' => $value->loan_type,
                'loan_reason' => $value->loan_reason,
                'loan_duration' => (int)$value->loan_duration,
                'loan_amount' => (int)$value->loan_amt,
                'loan_profit' => (int)$value->loan_profit,
                'loan_date' => $value->loan_date,

                'txt_inst_amt' => (int)$value->loan_amt / (int)($value->loan_duration),
                'inst_profit' => (int)$value->loan_profit / (int)($value->loan_duration),

                'paid_loan_amt' => $value->loan_amount,
                'paid_loan_profit' => $value->cur_profit,
                'total_paid_amt' => $value->total_paid_amount,
                'remain_total_paid_amt' => (int)$value->loan_amt + (int)$value->loan_profit - (int)$value->total_paid_amount,
                'paid_inst' => $value->total_installment,
                'remain_inst' => (int)$value->loan_duration - (int)$value->total_installment,
                'installment' => $value->loan_installment,
                'last_installment' => $value->last_installment_paid,
            ];
        }
        return response($data);
    }
}
