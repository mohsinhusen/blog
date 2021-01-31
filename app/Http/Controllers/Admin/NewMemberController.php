<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewMemberModel;
use App\Models\Member_Invest;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewMemberController extends Controller
{
    public function index()
    {
        // $member = Member_Invest::select(DB::raw("SUM(member_investment.amount) as current_amount,
        //     SUM(member_investment.p_share) as p_share,
        //     member.id,member.name, member_investment.member_id,member.role"))
        //     ->leftJoin('member', 'member_investment.member_id', '=', 'member.id')
        //     ->groupBy(DB::raw("member_investment.member_id,member.name,member.id,member.role"))
        //     ->get();

        // echo "<pre>";
        // print_r($member);
        // die();
        $member = NewMemberModel::orderBy('id', 'ASC')->get();

        $total_member = NewMemberModel::where('role', 'member')->orderBy('id', 'DESC')->count();
        $nonmember = NewMemberModel::where('role', 'other')->orderBy('id', 'DESC')->get();
        $total_nonmember = NewMemberModel::where('role', 'other')->orderBy('id', 'DESC')->count();

        return view('admin.register.member')->with([
            'member' => $member,
            'total_member' => $total_member,
            'nonmember' => $nonmember,
            'total_nonmember' => $total_nonmember
        ]);
    }
    public function create()
    {
        $id = 1;
        $member = NewMemberModel::all();
        if (!$member->isEmpty()) {
            $id = NewMemberModel::all()->max()->id + 1;
        }
        return view('admin.register.create')->with('id', $id);
    }


    public function store(CreateUser $request)
    {
        $member = new NewMemberModel;
        $member->name = $request->name;
        $member->address = $request->address;
        $member->role = $request->membertype;
        $member->mobile = $request->mobile;
        $member->email = $request->email;
        $upassword = $request->password;
        $member->password = Hash::make($upassword);
        $member->pur_share = $request->pur_share;
        $member->remember_token = 0;
        $member->status = 1;
        $member->save();
        return redirect('/new-member')->with('status', 'Member Added Successfully');
    }

    public function edit($id)
    {
        $member = NewMemberModel::all();
        $member = NewMemberModel::findorFail($id);
        return view('admin.register.edit')
            ->with('member', $member);
    }

    public function update(UpdateUser $request, $id)
    {
        $member = NewMemberModel::find($id);
        $member->name = $request->name;
        $member->address = $request->address;
        $member->mobile = $request->mobile;
        $member->email = $request->email;
        $upassword = $request->password;
        $member->password = Hash::make($upassword);
        $member->pur_share = $request->purchase_share;
        $member->role = $request->membertype;
        $member->status = $request->status;
        $member->update();

        // Session::flash('statuscode','success');
        return redirect('/new-member')->with('status', 'Member Updated Successfully');
    }

    public function delete($id)
    {
        $member = NewMemberModel::findOrFail($id);
        $member->delete();
        return response()->json(['status' => 'Member Deleted Successfully!']);
    }
}
