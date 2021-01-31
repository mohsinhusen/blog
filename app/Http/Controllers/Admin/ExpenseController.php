<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Session;

class ExpenseController extends Controller
{
    public function view_expense()
    {
        $expense = Expense::all();
        return view('admin.expense.viewExpense')->with('expense', $expense);
    }

    public function create()
    {
        $id = 1;
        $v_no = Expense::all();
        if (!$v_no->isEmpty()) {
            $id = Expense::all()->max()->id + 1;
        }

        return view('admin.expense.addExpense')->with('id', $id);
    }

    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->exp_date = $request->input('exp_date');
        $expense->exp_amount = $request->input('exp_amount');
        $expense->exp_description = $request->input('exp_descr');
        $expense->status = 1;
        $expense->save();
        return redirect('/view-expense')->with('status', 'Expense Add Successfully');
    }

    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('admin.expense.editExpense')
            ->with('status', 'Expense Edit Successfully')
            ->with('expense', $expense);
    }
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->exp_description = $request->input('exp_descr');
        $expense->exp_amount = $request->input('exp_amount');
        $expense->exp_date = $request->input('exp_date');
        $expense->update();
        return redirect('/view-expense')->with('status', 'Expense Updated Successfully');
    }
    public function delete($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(['status' => 'Expense Deleted Successfully!']);
    }
}
