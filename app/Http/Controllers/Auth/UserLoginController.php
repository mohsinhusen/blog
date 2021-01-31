<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.userlogin', ['url' => 'member']);
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/userDashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
