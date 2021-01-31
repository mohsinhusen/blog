<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalHelp;
use Illuminate\Support\Facades\DB;

use Session;

class Help extends Controller
{
    public function create()
    {
        return view('admin.help.help_create');
        //->with('expense', $expense);
    }
    public function store(Request $request)
    {
        $help = new MedicalHelp();
        $help->help_name = $request->input('help_name');
        $help->help_amount = $request->input('help_amount');
        $help->help_description = $request->input('help_description');
        $help->help_date = $request->input('help_date');
        $help->status = 1;
        $help->save();
        Session::flash('status', 'success');
        return redirect('/role-view-help')->with('status', 'Help Add Successfully');
    }
    public function view_help()
    {
        $help = MedicalHelp::all();
        return view('admin.help.help_view')->with('help', $help);
    }
    public function edit_view_help($id)
    {
        $help = MedicalHelp::find($id);
        return view('admin.help.help_viewEdit')->with('help', $help);
    }
    public function edit_help(Request $request, $id)
    {
        $help = MedicalHelp::find($id);
        $help->help_name = $request->input('help_name');
        $help->help_amount = $request->input('help_amount');
        $help->help_description = $request->input('help_description');
        $help->help_date = $request->input('help_date');
        $help->status = $request->input('status');
        $help->update();
        Session::flash('status', 'success');
        return redirect('/role-view-help')->with('status', 'Help Edit Successfully');
    }

    public function delete($id)
    {
        $help = MedicalHelp::findOrFail($id);
        $help->delete();
        return response()->json(['status' => 'Help Deleted Successfully!']);
    }
    public function report_help()
    {
        $help = DB::table('help')
            ->where('status', 1)
            ->get();
        $total_c_help = DB::table('help')
            ->where('status', 1)
            ->get()->count();
        $totalhelp = DB::table('help')
            ->where('status', 0)
            ->get();
        $total_r_help = DB::table('help')
            ->where('status', 0)
            ->get()->count();

        return view('admin.help.Help_Report')->with([
            'help' => $help,
            'totalhelp' => $totalhelp,
            'total_r_help' => $total_r_help,
            'total_c_help' => $total_c_help
        ]);
    }
}
