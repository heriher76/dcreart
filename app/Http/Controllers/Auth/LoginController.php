<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logoutAdmin');
        $this->middleware('guest:admin')->except('logoutAdmin');
    }

    public function showLoginFormAdmin()
    {
        return view('pages.admin.auth.login');
    }

    public function authenticateAdmin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->intended(route('admin.post.index'));
        }
    
        return back()->with([
            'error' => 'email atau Password salah',
        ]);

    }

    public function logoutAdmin(Request $request)
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login.form');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin.login.form');
    }
}
