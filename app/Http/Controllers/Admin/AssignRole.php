<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use Session;

use Illuminate\Support\Facades\DB;

class AssignRole extends Controller
{

   public function create()
   {
      return view('admin.role.AssignRole');
   }

   public function view_role()
   {
      $user = User::all();
      return view('admin.role.view-role')->with('user', $user);
   }

   //    protected function validator(array $data)
   //     {
   //         return Validator::make($data, [
   //             'username' => ['required', 'string', 'max:255'],
   //             'mobile' => ['required', 'string', 'max:10','min:10'],
   //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
   //             'password' => ['required', 'string', 'min:8', 'confirmed'],
   //         ]);
   //     }


   public function store(Request $request)
   {
      $user = new User();
      $user->name = $request->input('username');
      $user->phone = $request->input('mobile');
      $user->usertype = $request->input('typeuser');
      $user->email = $request->input('email');
      $userpassword = $request->input('password');
      $user->password = Hash::make($userpassword);
      $user->save();

      return redirect('/view-role')->with('status', 'User Add Successfully');
   }

   public function edit_role($id)
   {
      $user = new User();
      $user = User::find($id);
      return view('admin.role.EditRole')
         ->with('status', 'Expense Edit Successfully')
         ->with('user', $user);
   }
   public function update(Request $request, $id)
   {
      $user = new User();
      $user = User::findorFail($id);
      $user->name = $request->input('username');
      $user->phone = $request->input('mobile');
      $user->usertype = $request->input('typeuser');
      $user->email = $request->input('email');
      $userpassword = $request->input('password');
      $user->password = Hash::make($userpassword);
      $user->update();
      return redirect('/view-role')->with('status', 'Update Successfully');
   }
   public function delete($id)
   {
      $user = User::findOrFail($id);
      $user->delete();
      return response()->json(['status' => 'User Deleted Successfully!']);
   }
}
