<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewLoan;
use App\Models\Loan_Application;

use Session;
use Carbon\Carbon;


class LoanApplication extends Controller
{
    public function create_loan()
    {
        $currentDate = Carbon::now();
        $Current_Month = $currentDate->month;
        $Current_Year = $currentDate->year;

        $id = Auth::guard('member')->user()->id;

        $loan_request = DB::table('loan_application')
            ->where('member_id', $id)
            ->whereMonth('date', $Current_Month)
            ->whereYear('date', $Current_Year)
            ->get();

        $result = $loan_request->isEmpty();

        if ($result == true) {
            return view('user.Loan.newLoan')->with(['id' => $id]);
        } else {
            return view('user.Loan.loanExist');
        }
    }


    public function store(NewLoan $request)
    {
        $id = Auth::guard('member')->user()->id;
        $duplicate = DB::table('loan')
            ->where('member_id', $id)->count();
        if ($duplicate  < 5) {
            $id = Auth::guard('member')->user()->id;
            $name = Auth::guard('member')->user()->name;
            $currentDate = Carbon::now();
            $Current_Date = $currentDate->toDateTimeString();
            $newLoan = new Loan_Application();
            $newLoan->member_id = $id;
            $newLoan->name = $name;
            $newLoan->date = $Current_Date;
            $newLoan->loan_type = $request->input('loan_type');
            $newLoan->loan_reason = $request->input('loan_reason');
            $newLoan->loan_amount = $request->input('loan_amount');
            $newLoan->loan_duration = $request->input('loan_duration');
            $newLoan->status = 1;
            $newLoan->save();
            return view('user.Loan.loanSucess');
        } else {
            return view('user.Loan.loanError');
        }
    }
}
