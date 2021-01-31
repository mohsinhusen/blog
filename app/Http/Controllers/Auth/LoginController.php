<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    use AuthenticatesUsers;



    protected function redirectTo()
    {
        if (Auth::user()->usertype == 'admin') {
            return 'dashboard';
        } elseif (Auth::user()->usertype == 'subAdmin') {
            return '/sub-admindashboard';
        } else {
            return '/welcome';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:member')->except('logout');
    }

    public function ShowMemberLogin()
    {
        return view('auth.Login', ['url' => 'member']);
    }


    public function MemberLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/member-dashboard');
        }
        return back()->withErrors(['These credentials do not match our records.', 'The Message']);
    }
}
