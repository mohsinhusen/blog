<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member_Invest;
use App\Models\NewMemberModel;
use App\Models\LoanInstallment;
use Illuminate\Support\Facades\DB;

class MemberInvestment extends Controller
{

    public function index($id)
    {
        $last_payment = Member_Invest::orderBy('id', 'DESC')->first();
        $payment = NewMemberModel::find($id);
        $member_detail = Member_Invest::where('member_id', array($id))->get();
        return view('admin.invest.add')->with([
            'payment' => $payment,
            'last_payment' => $last_payment,
            'member_detail' => $member_detail
        ]);
    }

    public function edit_view($id)
    {
        $investment = Member_Invest::find($id);
        return view('admin.invest.editInvest')
            ->with('investment', $investment);
    }

    public function update(Request $request, $id)
    {
        $member_id = $request->input('member_id');
        $amount = $request->input('amount');
        $inv_date = $request->input('inv_date');
        $isExist = Member_Invest::select("*")
            ->where("member_id", $member_id)
            ->where("amount", $amount)
            ->where("date", $inv_date)
            ->exists();
        if ($isExist == true) {
            return redirect('new-member')
                ->with('error', 'Payment exist on the day');
        } else {
            $investment = Member_Invest::find($id);
            $investment->amount = $request->input('amount');
            $investment->date = $request->input('inv_date');
            $investment->loan_status = $request->input('status');
            $investment->status = 1;
            $investment->update();
            return redirect('new-member')->with('status', 'Recrod Updated Successfully');
        }
    }

    public function store(Request $request)
    {
        $member_id = $request->input('member_id');
        $amount = $request->input('amount');
        $inv_date = $request->input('inv_date');
        $isExist = Member_Invest::select("*")
            ->where("member_id", $member_id)
            ->where("amount", $amount)
            ->where("date", $inv_date)
            ->exists();
        if ($isExist == true) {
            return redirect('new-member')
                ->with('error', 'Payment exist  on the day');
        } else {
            $investment = new Member_Invest;
            $member_id = $request->input('member_id');
            $p_share = $request->input('p_share');
            $investment->member_id = $member_id;
            $investment->p_share = $p_share;
            $investment->amount = $request->input('amount');
            $investment->date = $request->input('inv_date');
            $investment->loan_status = $request->input('status');
            $investment->status = 1;
            $investment->save();
            return redirect('/new-member')
                ->with('status', 'Payment Add Successfully');
        }
    }

    public function view_investment($id)
    {
        $invest = NewMemberModel::select('member_investment.*', 'member.*')
            ->join('member_investment', 'member_investment.member_id', 'member.id')
            ->where('role', 'member')
            ->where('member_id', array($id))
            ->get()->first();

        if ($invest != null) {
            $member_detail = Member_Invest::where('member_id', array($id))->get();

            $purchase_share = Member_Invest::select('p_share')
                ->where('member_id', '=', array($id))->sum('p_share');

            $total_amt = Member_Invest::whereRaw('member_id = ?', array($id))->sum('amount');

            $total_share_amt = Member_Invest::sum('amount');
            $loan_cur_prft = LoanInstallment::sum('amount_profit');
            $total_pshare = Member_Invest::sum('p_share');

            return view('admin.invest.viewInvest')
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

            return view('admin.register.error_invest');
        }
    }

    public function delete($id)
    {
        $user = Member_Invest::findOrFail($id);
        $user->delete();
        return response()->json(['status' => 'Record Deleted Successfully!']);
    }
    public function member()
    {
        $member = Member_Invest::select(DB::raw("SUM(member_investment.amount) as current_amount,
            SUM(member_investment.p_share) as p_share,
            member.id,member.name, member_investment.member_id,member.role"))
            ->leftJoin('member', 'member_investment.member_id', '=', 'member.id')
            ->groupBy(DB::raw("member_investment.member_id,member.name,member.id,member.role"))
            ->where('role', 'member')
            ->get();
        $total_pshare = Member_Invest::sum('p_share');
        $total_share_amt = Member_Invest::sum('amount');

        return view('admin.invest.listMember')
            ->with([
                'member' => $member,
                'total_pshare' => $total_pshare,
                'total_share_amt' => $total_share_amt
            ]);
    }
    public function non_member()
    {
        $non_member = NewMemberModel::where('role', 'other')->get();
        return view('admin.invest.nonMember')
            ->with([
                'non_member' => $non_member
            ]);
    }
}
