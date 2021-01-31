<?php

namespace App\Http\Controllers\subAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\NewMemberModel;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Notification;
use App\Notifications\Inst_Notification;

class Dashboard extends Controller
{
    public function getmember_detail()
    {
        $loan_id = $_POST['id'];
        $member_id = Loan::whereRaw('id = ?', array($loan_id))
            ->get()->first();
        $installment = $member_id->loan_installment;
        return response()->json(['installment' => $installment]);
    }

    public function index()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $loan = new Loan;
        $total_active_loan = Loan::whereRaw('status = ?', 1)->count();
        $total_return_installment = Loan::whereRaw('status = ?', 1)->sum('loan_installment');

        $loan = Loan::whereRaw('status = ?', 1)->count();
        $loan_installment = Loan::whereRaw('status = ?', 1)->sum('loan_installment');

        $collect_pay = NewMemberModel::select(DB::raw("SUM(loan_installment.inst_amount) as sumofinstallment,member.id"))
            ->join('loan_installment', 'member.id', 'loan_installment.member_id')
            ->groupBy(DB::raw("member.id"))
            ->whereBetween('loan_installment.inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get()->sum('sumofinstallment');

        $total_repay = LoanInstallment::whereBetween('inst_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->count();

        $unpaid = ($loan - $total_repay);
        $due_pay = ($loan_installment - $collect_pay);

        //     echo "<pre>"; print_r($collect_pay); die();      

        return view('admin.collection.dashboard')
            ->with([
                'total_active_loan' => $total_active_loan,
                'total_return_installment' => $total_return_installment,
                'collect_pay' => $collect_pay,
                'total_repay' => $total_repay,
                'unpaid' => $unpaid,
                'due_pay' => $due_pay,
                'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
                'lastDayofPreviousMonth' => $lastDayofPreviousMonth
            ]);
    }

    public function new_installment()
    {
        $installment_details = LoanInstallment::leftjoin('member', 'loan.member_id', 'member.id')
            ->where('loan.status', 1)
            ->get();

        return view('admin.collection.newinstallment')
            ->with([
                'installment_details' => $installment_details,
            ]);
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

        return view('admin.collection.collectRepay')->with([
            'collect_pay' => $collect_pay,
            'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
            'lastDayofPreviousMonth' => $lastDayofPreviousMonth
        ]);
    }

    public function collect_due()
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();

        $due = Loan::select('loan.id', 'loan.member_id', 'member.name', 'loan.loan_installment', 'loan.loan_no')
            ->join('member', 'member.id', 'loan.member_id')
            ->where('loan.status', 1)
            ->get();
        $result = [];
        foreach ($due as $key => $value) {
            $member_detail = DB::select('select * from loan_installment where inst_date 
            BETWEEN ? AND ? AND(member_id = ? AND loan_id=?)  ', array($firstDayofPreviousMonth, $lastDayofPreviousMonth, $value->member_id, $value->id));
            if (empty($member_detail)) {
                $result[$key]['loan_id'] = $value->id;
                $result[$key]['loan_no'] = $value->loan_no;
                $result[$key]['memeber_id'] = $value->member_id;
                $result[$key]['member_name'] = $value->name;
                $result[$key]['loan_installment'] = $value->loan_installment;
            }
        }

        return view('admin.collection.due-Repay')->with([
            'result' => $result,
            'firstDayofPreviousMonth' => $firstDayofPreviousMonth,
            'lastDayofPreviousMonth' => $lastDayofPreviousMonth
        ]);
    }



    public function active_loan()
    {
        $loan = Loan::select('member.*', 'loan.*')
            ->join('member', 'member.id', 'loan.member_id')
            ->where('loan.status', 1)
            ->orderBy('loan.id', 'DESC')
            ->get();
        return view('admin.collection.activeLoan')->with([
            'loan' => $loan
        ]);
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
                ->get();

            $current_profit = LoanInstallment::select(
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
                ->where('loan_installment.loan_id', array($id))
                ->get()->first();

            return view('admin.collection.viewInstallment')->with([
                'installment_details' => $installment_details,
                'installment_statement' => $installment_statement,
                'current_profit' => $current_profit,
                'id' => $id
            ]);
        } else {
            $installment_details = DB::table('member')
                ->leftjoin('loan', 'member.id', 'loan.member_id')
                ->where('loan.status', 1)
                ->get();

            $last_installment = DB::table('loan_installment')
                ->join('member', 'loan_installment.member_id', 'member.id')
                ->join('loan', 'member.id', 'loan.id')
                ->where('loan.status', 1)
                ->get()->last();
            return view('admin.collection.newinstallment')
                ->with([
                    'installment_details' => $installment_details,
                    'last_installment' => $last_installment
                ]);
        }
    }

    public function add_installment(Request $request)
    {
        $installment = new LoanInstallment;
        $loan_id = $request->input('loan_id');
        $inst_date = $request->input('inst_date');
        $inst_amount = $request->input('inst_amt');
        $profit = DB::table('loan')
            ->whereRaw('id = ?', array($loan_id))
            ->get()->first();
        $member_id = $profit->member_id;


        $duplicate = DB::select("select * from loan_installment where member_id='$member_id' AND loan_id='$loan_id' AND inst_date='$inst_date' AND inst_amount='$inst_amount'");
        //    echo "<pre>"; print_r($duplicate); die();
        if (collect($duplicate)->first()) {

            return redirect('/role-installment')->with('status', 'Already Exist Installment now');
        } else {
            $profit = DB::table('loan')
                ->whereRaw('id = ?', array($loan_id))
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

            $installment_data = [
                'loan_id' =>$installment->loan_id = $l_id,
                'member_id' =>$installment->member_id = $member_id,
                'inst_amount' =>$installment->inst_amount = $request->input('inst_amt'),
                'inst_date' =>$installment->inst_date = $request->input('inst_date'),
                'inst_penalty' =>$installment->inst_penalty = $request->input('inst_penalty'),
            ];

            
            Notification::send($installment, new Inst_Notification($installment_data));
            
            return redirect('/collection-due')->with('status', 'Installment Added Successfully');
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
